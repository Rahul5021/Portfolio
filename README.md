# Rahul Agrawal — Portfolio

Personal portfolio website showcasing my work in data analysis, AI/GenAI engineering, and business analytics.

**Live site:** [rahulagrawal.com.np](https://rahulagrawal.com.np)

## About

Data Analyst with hands-on experience in financial and healthcare analytics, currently
building toward AI/GenAI engineering. This site showcases my projects, skills, and
background — built as a fully static site for speed, simplicity, and zero-maintenance
hosting, with a distinctive "ledger & data" visual identity reflecting a background in
retail business before moving into data.

## Tech stack

- HTML5, CSS3, vanilla JavaScript
- [Bootstrap 5](https://getbootstrap.com/) for layout components and modal
- [Devicon](https://devicon.dev/) for skill icons
- Fraunces, IBM Plex Sans, IBM Plex Mono (Google Fonts) for the ledger-inspired typography
- [Web3Forms](https://web3forms.com/) for contact form submission (no backend required),
  with hCaptcha and spam filtering
- [Font Awesome](https://fontawesome.com/) for supplementary icons

## Structure

```
├── index.html
├── styles/
│   └── style.css
├── scripts/
│   └── scripts.js
└── assets/
    ├── favicon.ico
    ├── profile_pic.webp
    ├── icon/
    └── project_images/
```


## Features

- Responsive design (mobile, tablet, desktop)
- Accessible navigation with keyboard support (`aria-expanded` state on mobile menu)
- Real-time contact form validation with hCaptcha
- Custom domain email (`contact@rahulagrawal.com.np`) via Cloudflare Email Routing
- SEO-optimized with Open Graph, Twitter Card, and Schema.org structured data
- Fast static hosting via Cloudflare Workers — no server or database required

## Deployment

This site is deployed via **Cloudflare Workers** (static assets), connected directly to
this repository through a committed `wrangler.jsonc` configuration. Any push to `main`
automatically redeploys the live site. DNS, custom email routing, and a `www` → root
redirect are all managed through the same Cloudflare account.

## Projects featured

| Project | Stack | Link |
|---|---|---|
| E-Commerce AI Assistant | Python, Gemini API, RAG (FAISS + MMR), DuckDB, Streamlit | [GitHub](https://github.com/Rahul5021/ecommerce-ai-assistant) |
| Global Terrorism Trends Analysis | Python, pandas, Power BI, Geospatial Analysis | [GitHub](https://github.com/Rahul5021/global-terrorism-eda) |
| Crop Recommendation System | Flask, Machine Learning, REST APIs | [GitHub](https://github.com/Rahul5021/crop-recommendation-system) |
| Air Quality Classifier | Python, Flask, Docker | [GitHub](https://github.com/Rahul5021/air-quality-classifier) |

## Contact

- Email: contact@rahulagrawal.com.np
- LinkedIn: [agrawalrahul1025](https://www.linkedin.com/in/agrawalrahul1025/)
- GitHub: [Rahul5021](https://github.com/Rahul5021)
- Kaggle: [rahulagrawal1025](https://www.kaggle.com/rahulagrawal1025)

## License

Personal project — feel free to reference the structure, but please don't copy the content directly.
