import tempfile
import unittest
from pathlib import Path

from scripts.build_site import build, local_target, validate_site


class StaticSiteTests(unittest.TestCase):
    def test_valid_internal_links(self):
        with tempfile.TemporaryDirectory() as temp:
            root = Path(temp)
            (root / "index.html").write_text('<!doctype html><html lang="en"><head><title>Site</title></head><body><h1>Hi</h1><a href="blog/">Blog</a><a href="https://example.com">External</a></body></html>')
            (root / "blog").mkdir()
            (root / "blog/index.html").write_text('<!doctype html><html lang="en"><head><title>Blog</title></head><body><h1>Writing</h1><a href="../index.html">Home</a></body></html>')
            self.assertEqual(validate_site(root), [])

    def test_missing_local_asset_blocks_build(self):
        with tempfile.TemporaryDirectory() as temp:
            root = Path(temp)
            (root / "index.html").write_text('<!doctype html><html lang="en"><head><title>Site</title></head><body><h1>Hi</h1><img src="assets/missing.png"></body></html>')
            issues = build(root, root / "dist")
            self.assertTrue(any("missing.png" in error for error in issues))

    def test_template_is_not_published(self):
        with tempfile.TemporaryDirectory() as temp:
            root = Path(temp)
            (root / "index.html").write_text('<!doctype html><html lang="en"><head><title>Site</title></head><body><h1>Hi</h1></body></html>')
            (root / "blog").mkdir()
            (root / "blog/_article-template.html").write_text("not for public")
            self.assertEqual(build(root, root / "dist"), [])
            self.assertFalse((root / "dist/blog/_article-template.html").exists())

    def test_existing_javascript_folder_is_published(self):
        with tempfile.TemporaryDirectory() as temp:
            root = Path(temp)
            (root / "scripts").mkdir()
            (root / "scripts/scripts.js").write_text("console.log('works');")
            (root / "index.html").write_text('<!doctype html><html lang="en"><head><title>Site</title></head><body><h1>Hi</h1><script src="scripts/scripts.js"></script></body></html>')
            self.assertEqual(build(root, root / "dist"), [])
            self.assertTrue((root / "dist/scripts/scripts.js").is_file())

    def test_url_with_encoded_space(self):
        with tempfile.TemporaryDirectory() as temp:
            root = Path(temp)
            page = root / "index.html"
            self.assertEqual(local_target("assets/DA%20Resume.pdf", page, root), root / "assets/DA Resume.pdf")


if __name__ == "__main__":
    unittest.main()
