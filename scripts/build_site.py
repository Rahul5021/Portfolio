"""Validate and package Rahul's static portfolio for Cloudflare Pages.

Usage (from the repository root): python scripts/build_site.py
Output: dist/
No third-party Python packages required.
"""
from __future__ import annotations

import html
import re
import shutil
import sys
from html.parser import HTMLParser
from pathlib import Path
from urllib.parse import unquote, urlsplit

ROOT = Path(__file__).resolve().parent.parent
DIST = ROOT / "dist"
SKIP_DIRS = {".git", ".github", ".vscode", ".idea", "dist", "node_modules", "venv", ".venv", "__pycache__", "tests"}
SKIP_FILES = {"_article-template.html", ".gitignore", ".gitattributes", ".DS_Store"}
PUBLISH_EXTS = {".html", ".css", ".js", ".json", ".png", ".jpg", ".jpeg", ".webp", ".gif", ".svg", ".ico", ".mp4", ".webm", ".mp3", ".wav", ".ogg", ".pdf", ".woff", ".woff2", ".ttf", ".eot", ".webmanifest", ".txt", ".xml", ".csv", ".wasm", ".avif"}
SPECIAL_FILES = {"_headers", "_redirects", "CNAME"}

class PageInspector(HTMLParser):
    def __init__(self) -> None:
        super().__init__(convert_charrefs=True)
        self.refs: list[tuple[str, str]] = []
        self.has_title = False
        self.has_h1 = False
        self.has_html_lang = False

    def handle_starttag(self, tag: str, attrs: list[tuple[str, str | None]]) -> None:
        a = dict(attrs)
        if tag == "html" and a.get("lang"):
            self.has_html_lang = True
        if tag == "title":
            self.has_title = True
        if tag == "h1":
            self.has_h1 = True
        for name in ("href", "src", "poster", "data"):
            value = a.get(name)
            # 'data' only applies to <object>, not data-* attributes.
            if value and (name != "data" or tag == "object"):
                self.refs.append((name, value.strip()))
        if a.get("srcset"):
            for item in a["srcset"].split(","):
                url = item.strip().split(" ")[0]
                if url:
                    self.refs.append(("srcset", url))


def local_target(value: str, current_html: Path, root: Path) -> Path | None:
    """Convert a local URL to a file in the output tree; None means external/anchor."""
    value = html.unescape(value).strip()
    if not value or value.startswith(("#", "//")):
        return None
    parsed = urlsplit(value)
    if parsed.scheme or parsed.netloc:
        return None
    path = unquote(parsed.path)
    if not path:
        return None  # query/fragment-only links
    if path.startswith("/"):
        target = root / path.lstrip("/")
    else:
        target = current_html.parent / path
    target = target.resolve()
    if not target.is_relative_to(root.resolve()):
        raise ValueError("local path escapes site root")
    if target.is_dir() or path.endswith("/"):
        target /= "index.html"
    return target


def validate_site(root: Path) -> list[str]:
    errors: list[str] = []
    if not (root / "index.html").is_file():
        errors.append("Missing home page: index.html")
    pages = sorted(root.rglob("*.html"))
    for page in pages:
        rel = page.relative_to(root).as_posix()
        data = page.read_text(encoding="utf-8-sig")
        inspector = PageInspector()
        try:
            inspector.feed(data)
            inspector.close()
        except Exception as exc:
            errors.append(f"{rel}: couldn't parse HTML ({exc})")
            continue
        if not re.search(r"<!doctype\s+html", data, flags=re.IGNORECASE):
            errors.append(f"{rel}: missing <!DOCTYPE html>")
        if not inspector.has_html_lang:
            errors.append(f"{rel}: missing <html lang=...>")
        if not inspector.has_title:
            errors.append(f"{rel}: missing <title>")
        if not inspector.has_h1:
            errors.append(f"{rel}: missing <h1>")
        for attribute, url in inspector.refs:
            try:
                target = local_target(url, page, root)
            except ValueError as exc:
                errors.append(f"{rel}: {attribute}='{url}' ({exc})")
                continue
            if target is not None and not target.is_file():
                errors.append(f"{rel}: missing local file in {attribute}='{url}'")
    return errors


def publishable(path: Path) -> bool:
    return path.name in SPECIAL_FILES or path.suffix.lower() in PUBLISH_EXTS


def build(root: Path = ROOT, dist: Path = DIST) -> list[str]:
    root = root.resolve()
    dist = dist.resolve()
    if dist == root or not dist.is_relative_to(root):
        raise ValueError("Output directory must be a subdirectory of the project")
    if dist.exists():
        shutil.rmtree(dist)
    dist.mkdir(parents=True)
    copied = 0
    for path in root.rglob("*"):
        if not path.is_file():
            continue
        rel = path.relative_to(root)
        if any(part in SKIP_DIRS for part in rel.parts[:-1]):
            continue
        if path.name in SKIP_FILES or not publishable(path):
            continue
        destination = dist / rel
        destination.parent.mkdir(parents=True, exist_ok=True)
        shutil.copy2(path, destination)
        copied += 1
    errors = validate_site(dist)
    print(f"Copied {copied} published files to {dist.relative_to(root)}/")
    if errors:
        for error in errors:
            print(f"ERROR: {error}", file=sys.stderr)
        print(f"Validation failed: {len(errors)} error(s). Deployment blocked.", file=sys.stderr)
    else:
        print(f"Validation passed: {len(list(dist.rglob('*.html')))} HTML page(s), all referenced local files exist.")
    return errors


if __name__ == "__main__":
    sys.exit(1 if build() else 0)
