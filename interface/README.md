# OpenEMR-interface

The OpenEMR-interface uses [Storybook](https://storybook.js.org) to document and standardize the creation of user interface elements. The project is using bootstrap as base and is built with [SASS](https://sass-lang.com/) (compiled with [gulp](https://gulpjs.com/)).

The live version of this guide can be found at [openemr-interface.surge.sh](http://openemr-interface.surge.sh).

### Themes

Different `themes` share a common `core` and have their own overrides to customize the appearance of OpenEMR. You can view how these themes differ using the "Knobs" tool at the bottom of the storybook interface.

There are three different types of themes:
* The `light` theme is the default modern theme
* The `manila` theme is a combination of OpenEMR's legacy themes (which have all been removed) with some modern elements.
* The other themes (called `colors`) are the same `color_base` theme with different color palettes.

`rtl_` prefixed themes are built by appending the `rtl.css` file to every theme automatically. These overrides provide right to left adjustments for all `style*.css` files

Files specific to different themes are named with the following conventions:
* `themes/core` contain shared styles that all themes import toward the top of their files
* `themes/colors` contain all changes specific to the color theme work (led by [zbig01](https://github.com/zbig01))
* `themes/[component_name]` (e.g. `buttons` or `navigation-slide`) contain files named after each theme variant.
    * See TODOs on how we might be able to manage component-level styles in the future

### Special Classes

* `position-override` gives a hook for style to change placement of buttons. In light/manila style this is ignored and buttons go to left positioned under data entry field. Whereas in the other styles this is used to center the buttons.
* `oe-opt-btn-group-pinch` gives a hook for style to pinch the buttons (i think make them more rounded). Not used in light/manila, but used in other styles.
* `oe-opt-btn-separate-left` gives a hook to place a space between the buttons. Not used in light/manila, but used in other styles.
* `oe-text-to-right` does as it says (and then does the opposite for RTL languages).
* `oe-text-to-left` does as it says (and then does the opposite for RTL languages).

## Getting Started

Combiling SASS files locally requires [node.js](http://nodejs.org) and [npm](https://www.npmjs.com/).

**Setup local development environment:**

```
$ cd interface
$ npm install
```

From here you can either:
* `npm run dev-docs` - runs Storybook (proxied port 9001) and watches changes to local `.scss` files.
    * `http://localhost:3000` will refresh css automatically with [BrowserSync](http://www.browsersync.io/) after every change.
* `npm run dev` - just compiles the local `.scss` files and recompiles them whenever they are changed.
* `npm run dev 8081` (EXPERIMENTAL) - loads your local OpenEMR instance using BrowserSync (port 3000) in front of 8081 (you can use any port in this command) 

**If you're using docker** or other locally-hosted development environment, it is recommended that you automatically copy files to a mounted volume instead of mounting your working directory. See ["Option 2" in this doc](/contrib/util/docker/README.md) for more info.

### Development Environment Features

- Live preview sever
- CSS Autoprefixing
- Sass compilation (not yet using in our current themes)
- Browserify bundling
- Image optimization

## Build

**Build before you make your final css commit:**

```
$ npm run build
```

## TODOs
- [ ] Incorporate tabs_style_compact.css and tabs_style_full.css (and associated RTL) into scss
- [ ] Don't require 2 build runs to build the rtl themes
- [ ] Add built css (and other dependencies) to storybook .out directory
- [ ] Add a lot of documentation on current component usage (starting with theme-only components)
- [ ] Migrate style dependencies in the php code to use the components from the `interface` directory
- [ ] Migrate component css still left in the `/themes` directory into scss
