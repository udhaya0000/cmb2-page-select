CMB2 Page Select field
======================

Custom field for CMB2 which adds a post-search dialog for searching/attaching other post IDs.

Adds a new text field type (with a button), `page_select_text` that adds a quick post search dialog for saving post IDs to a text input.

## Example

```php
// Classic CMB2 declaration
$cmb = new_cmb2_box( array(
	'id'           => 'prefix-metabox-id',
	'title'        => __( 'Post Info' ),
	'object_types' => array( 'post', ), // Post type
) );

// Add new field
$cmb->add_field( array(
	'name'        => __( 'Related post' ),
	'id'          => 'prefix_related_post',
	'type'        => 'page_select_text', // This field type
	// post type also as array
	'post_type'   => 'post',
	// Default is 'checkbox', used in the modal view to select the post type
	'select_type' => 'radio',
	// Will replace any selection with selection from modal. Default is 'add'
	'select_behavior' => 'replace',
) );
```
