# Coalition

## Migration

Mirror the [Laravel](https://github.com/epforgpl/coalition) site:

```bash
wget -r -l inf --no-remove-listing --page-requisites --no-verbose -o debug.log https://www.open-procurement.eu
```

Then, remove query strings from file names:

```bash
mv js/app.js?id=158ecbd3d232ef8e2dd8 js/app.js
```

The `debug.log` file was then checked for `ERROR` messages.

A few manual changes were made:

- Move pages like `evidence` into directories like `evidence.html`
- Add images served from `open-procurement.eu`
- Reduce file hierarchy for uploaded images
- Replace absolute URLs with relative URLs
- Use `<base>` tag to fix URLs on GitHub Pages

The app.css` and `app.js` files are compiled. The source files are in the `src/` directory.
