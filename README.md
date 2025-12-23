---
title: "README"
date: 2021-05-27
draft: false
layout: default
parent: Boilerplates
---

<!-- SHIELDS -->
[![Contributors][contributors-shield]][contributors-url]
[![Forks][forks-shield]][forks-url]
[![Stargazers][stars-shield]][stars-url]
[![Issues][issues-shield]][issues-url]
[![License][license-shield]][license-url]

<h3>modularity-pitea-hero</h3>
<p>
  A module for the Pitea Hero.
  <br />
  <a href="https://github.com/Considbrs-Webdev/modularity-pitea-hero/issues">Report Bug</a>
  ·
  <a href="https://github.com/Considbrs-Webdev/modularity-pitea-hero/issues">Request Feature</a>
</p>

## Table of Contents
- [Table of Contents](#table-of-contents)
- [About modularity-pitea-hero](#about-modularity-pitea-hero)
  - [Built With](#built-with)
- [Getting Started](#getting-started)
  - [Prerequisites](#prerequisites)
  - [Installation](#installation)
- [Usage](#usage)
- [Deploy](#deploy)
- [Roadmap](#roadmap)
- [Contributing](#contributing)
- [License](#license)
- [Acknowledgements](#acknowledgements)

## About modularity-pitea-hero

[![modularity-pitea-hero Screen Shot][product-screenshot]](https://example.com)

A WordPress Modularity module for creating hero sections on Piteå municipality websites. This module provides a customizable hero section with background image, heading, search functionality, and action buttons.

### Features

* **Background Image**: Upload and display a background image for the hero section
* **Overlay Control**: Adjustable overlay opacity to ensure text readability
* **Custom Heading**: Set a main heading text for the hero section
* **Search Bar**: Integrated search functionality with customizable placeholder text
* **Action Buttons**: Add multiple buttons with icons and links to guide users

### Built With

* PHP
* NPM
* Webpack
* Modularity
* ACF (Advanced Custom Fields)
* Blade templating

## Getting Started

To get a local copy up and running follow these simple steps.

### Prerequisites

* WordPress with Modularity plugin installed
* PHP 7.4 or higher
* Composer
* Node.js and npm
* Advanced Custom Fields (ACF) plugin

Installation instructions:

* **Composer** (macOS):
```sh
brew install composer
```

* **Node.js and npm** (macOS):
```sh
brew install node
```

* **Modularity**:
```sh
composer require helsingborg-stad/modularity
```
### Installation

1. Clone the repo
```sh
git clone https://github.com/Considbrs-Webdev/modularity-pitea-hero.git
```
2. Install and build NPM packages
```sh
npm install && npm run build
```
3. Install composer packages
```sh
composer install
```

## Usage

After installation, the module will be available in the WordPress Modularity module library. You can add it to any page or post where Modularity is enabled.

### Module Configuration

1. **Background Image**: Upload a background image (required)
2. **Overlay Opacity**: Adjust the overlay darkness (0-100%, default: 50%)
3. **Heading**: Set the main heading text (required, default: "Välkommen till Piteå kommun")
4. **Search Placeholder**: Customize the search input placeholder text (optional, default: "Vad kan vi hjälpa dig med?")
5. **Buttons**: Add up to 12 action buttons with:
   - Icon selection
   - Button text
   - Link destination

The search bar will always be displayed, even if no placeholder text is set.

## Deploy

Instructions for deploys.

## Roadmap

See the [open issues][issues-url] for a list of proposed features (and known issues).

## Contributing

Contributions are what make the open source community such an amazing place to be learn, inspire, and create. Any contributions you make are **greatly appreciated**.

1. Fork the Project
2. Create your Feature Branch (`git checkout -b feature/AmazingFeature`)
3. Commit your Changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the Branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## License

Distributed under the [MIT License][license-url].

## Acknowledgements

- [othneildrew Best README Template](https://github.com/othneildrew/Best-README-Template)


<!-- MARKDOWN LINKS & IMAGES -->
<!-- https://www.markdownguide.org/basic-syntax/#reference-style-links -->
[contributors-shield]: https://img.shields.io/github/contributors/Considbrs-Webdev/modularity-pitea-hero.svg?style=flat-square
[contributors-url]: https://github.com/Considbrs-Webdev/modularity-pitea-hero/graphs/contributors
[forks-shield]: https://img.shields.io/github/forks/Considbrs-Webdev/modularity-pitea-hero.svg?style=flat-square
[forks-url]: https://github.com/Considbrs-Webdev/modularity-pitea-hero/network/members
[stars-shield]: https://img.shields.io/github/stars/Considbrs-Webdev/modularity-pitea-hero.svg?style=flat-square
[stars-url]: https://github.com/Considbrs-Webdev/modularity-pitea-hero/stargazers
[issues-shield]: https://img.shields.io/github/issues/Considbrs-Webdev/modularity-pitea-hero.svg?style=flat-square
[issues-url]: https://github.com/Considbrs-Webdev/modularity-pitea-hero/issues
[license-shield]: https://img.shields.io/github/license/Considbrs-Webdev/modularity-pitea-hero.svg?style=flat-square
[license-url]: https://raw.githubusercontent.com/Considbrs-Webdev/modularity-pitea-hero/master/LICENSE
[product-screenshot]: images/screenshot.png