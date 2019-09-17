# Recipe Runner web & docs

You can find the online version of Recipe Runner at https://recipe-runner.yosymfony.com

## Building the site

This site is built with [Jigsaw](https://jigsaw.tighten.co/).

Requires: PHP +7.1.3 and NPM.

```bash
composer install
npm install
npm run dev
composer godev
```

If you are running this site on a Vagrant environment such as Homestead, you may
get an error installing npm packages due to symlinks, see https://github.com/yarnpkg/yarn/issues/4908.
If so, run `npm install --no-bin-links` instead of `npm install`.
