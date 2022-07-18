# My Notes

These notes are for course [Become a WordPress Developer: Unlocking Power With Code](https://www.udemy.com/course/become-a-wordpress-developer-php-javascript), which is a great WordPress course with one of the best teachers out there

## Gutenberg Blocks

- Our Gutenberg Blocks use a JS structure like a "manual" React, and can be changed to a "JSX" React structure using the [@wordpress/scripts](https://www.npmjs.com/package/@wordpress/scripts) package
- Our Gutenberg Blocks created with `wp.blocks.registerBlockType` have a `save` attribute which is a function that given some received attributes generates an HTML that is saved on the database, if there's some kind of change on our block HTML it will "break" our block
- We can get rid of this "break" error in two ways:
  1. Using `deprecated` attribute which is a array of objects that are no longer valid, so if our `save` function is going to change we save the previous content of it inside this `deprecated` attribute
  2. Making the `save` function return null, and making the parse through PHP, that way our block is never going to "break", because there's no change if the return of the `save` function is always the same

## wp_enqueue_script

- Our JS script was being interpreted before the HTML of the post was in the page
- The last param of `wp_enqueue_script` is related to if the script is gonna be loaded on `head` or `body` tag

## Want More?

- The WordPress documentation on [this link](https://developer.wordpress.org/block-editor/how-to-guides/block-tutorial/block-controls-toolbar-and-sidebar/) can help you see more features for sidebar or controls related to our blocks
