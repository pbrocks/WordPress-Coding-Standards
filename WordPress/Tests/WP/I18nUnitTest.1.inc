<?php

// phpcs:set WordPress.WP.I18n check_translator_comments false

__( 'string' ); // OK - no text domain known, so not checked.
__( 'string', 'something' ); // OK - no text domain known, so not checked.

// phpcs:set WordPress.WP.I18n text_domain[] my-slug

__( 'string' ); // Bad - no text domain passed.
__( 'string', 'something' ); // Bad - text domain mismatch.
__( 'string', "my-slug-too" ); // Bad - text domain mismatch.

__( "hell$varo", 'my-slug' ); // Bad, shouldn't use a string with variables.
__( "hell\$varo", 'my-slug' ); // OK, Variable is not interpolated.
__( "hell\\$varo", 'my-slug' ); // Bad, is interpolated.
__( "hell\\\$varo", 'my-slug' ); // OK, variable is escaped.

__( $var, 'my-slug' ); // Bad, shouldn't use variables.

__( 'string', SOMETHING ); // Bad, shouldn't use CONSTANTS.

__( 'string' . $var, 'my-slug' ); // Bad, shouldn't use variable for string.
__( $var . 'string', 'my-slug' ); // Bad, shouldn't use variable for string.

__( SOMETHING, 'my-slug' ); // Bad, shouldn't use constant for string.
__( 'string' . SOMETHING, 'my-slug' ); // Bad, shouldn't use constant for string.
__( SOMETHING . 'string', 'my-slug' ); // Bad, shouldn't use variable for string.

__( 'string', $domain ); // Bad, shouldn't use variable for domain.
__( 'string', 'my' . $domain ); // Bad, shouldn't use variable for domain.
__( 'string', $domain . 'my-slug' ); // Bad, shouldn't use variable for domain.

__( 'string', 'my-slug' ); // Good.
_x( 'string', 'context', 'my-slug' ); // Good.

_x( 'string', $var, 'my-slug' ); // Bad, shouldn't use variable for context.
_x( 'string', 'context' . $var, 'my-slug' ); // Bad, shouldn't use variable for context.
_x( 'string', $var . 'context', 'my-slug' ); // Bad, shouldn't use variable for context.

_x( 'string', SOMETHING, 'my-slug' ); // Bad, shouldn't use constant for context.
_x( 'string', SOMETHING . 'context', 'my-slug' ); // Bad, shouldn't use constant for context.
_x( 'string', 'context' . SOMETHING, 'my-slug' ); // Bad, shouldn't use constant for context.

_n( 'I have %d cat.', 'I have %d cats.', $number ); // Bad, no text domain.
_n( 'I have %d cat.', 'I have %d cats.', $number, 'my-slug' ); // OK.
_n( 'I have %d cat.', 'I have %d cats.', $number, "illegal $string" ); // Bad.
_n( 'I have %d cat.', 'I have %d cats.', $number, SOMETHING ); // Bad.

_n_noop( 'I have %d cat.', 'I have %d cats.' ); // Bad, no text domain.
_n_noop( 'I have %d cat.', 'I have %d cats.', 'my-slug' ); // OK.
_n_noop( 'I have %d cat.', 'I have %d cats.', "illegal $string" ); // Bad.
_n_noop( 'I have %d cat.', 'I have %d cats.',  SOMETHING ); // Bad.

_nx( 'I have %d cat.', 'I have %d cats.', $number, 'Not really.' ); // Bad, no text domain.
_nx( 'I have %d cat.', 'I have %d cats.', $number, $context ); // Bad, no text domain, variable context.
_nx( 'I have %d cat.', 'I have %d cats.', $number, 'Not really.', 'my-slug' ); // OK.
_nx( 'I have %d cat.', 'I have %d cats.', $number, $context, 'my-slug' ); // Bad.
_nx( 'I have %d cat.', 'I have %d cats.', $number, 'Not really.', "illegal $string" ); // Bad.
_nx( 'I have %d cat.', 'I have %d cats.', $number, 'Not really.', SOMETHING ); // Bad.

_nx_noop( 'I have %d cat.', 'I have %d cats.', 'Not really.' ); // Bad, no text domain.
_nx_noop( 'I have %d cat.', 'I have %d cats.', $context ); // Bad, no text domain, variable context.
_nx_noop( 'I have %d cat.', 'I have %d cats.', 'Not really.', 'my-slug' ); // OK.
_nx_noop( 'I have %d cat.', 'I have %d cats.', $context, 'my-slug' ); // Bad.
_nx_noop( 'I have %d cat.', 'I have %d cats.', 'Not really.', "illegal $string" ); // Bad.
_nx_noop( 'I have %d cat.', 'I have %d cats.', 'Not really.', SOMETHING ); // Bad.

translate( 'foo', 'my-slug' ); // Bad, low-level API function.
translate_with_gettext_context( 'foo', 'bar', 'my-slug' ); // Bad, low-level API function.

_( 'foo', 'my-slug' ); // Bad.

__( 'foo', 'my-slug', 'too-many-args' ); // Bad.
_x( 'string', 'context', 'my-slug', 'too-many-args' ); // Bad.
_n( 'I have %d cat.', 'I have %d cats.', $number, 'my-slug', 'too-many-args' ); // Bad.
_n_noop( 'I have %d cat.', 'I have %d cats.', 'my-slug', 'too-many-args' ); // Bad.
_nx_noop( 'I have %d cat.', 'I have %d cats.', 'Not really.', 'my-slug', 'too-many-args' ); // Bad.

// Make sure that multi-line string literals are accepted.
_nx( 'I have
%d cat.', 'I have
%d cats.', $number, 'Not
really.', 'my-slug' ); // OK.

// Ensure lack of spaces doesn't cause i18n error.
_n_noop('I have %d cat.', 'I have %d cats.', 'my-slug'); // OK.

// Dollar sign in literal string is not interpolated, so OK.
_n_noop( 'I have %d cat.', 'I have %d cats literal-string-so-$variable-not-interpolated.', 'my-slug' ); // OK.

// Multiple placeholders should have orderable placeholders.
__( 'There are %d monkeys in the %s', 'my-slug' ); // Multiple arguments should be numbered.
__( 'There are %1$d monkeys in the %2$s', 'my-slug' ); // OK.
_n( 'There is %d monkey in the %s', 'There are %d monkeys in the %s', $number, 'my-slug' ); // Multiple arguments should be numbered.
_n( 'There is %1$d monkey in the %2$s', 'In the %2$s there are %1$d monkeys', $number, 'my-slug' ); // OK.

// The singular form should use placeholders if the plural does.
// https://codex.wordpress.org/I18n_for_WordPress_Developers#Plurals
_n( 'I have a cat.', 'I have %d cats.', $number, 'my-slug' ); // Bad, singular should have placeholder.
_n_noop( 'I have a cat.', 'I have %d cats.', 'my-slug' ); // Bad, singular should have placeholder.
_nx( 'I have a cat.', 'I have %d cats.', $number, 'Not really.', 'my-slug' ); // Bad, singular should have placeholder.
_nx_noop( 'I have a cat.', 'I have %d cats.', 'Not really.', 'my-slug' ); // Bad, singular should have placeholder.

__( '%s', 'my-slug' ); // Bad, don't waste translator's time.
__( '%1$s%2$s', 'my-slug' ); // Bad, don't waste translator's time.
_n( 'I have %d cat.', '%d', $number, 'my-slug' ); // Bad, move the logic out of the translation.
__( '\'%s\'', 'my-slug' ); // OK (ish. this is a technical test, not a great string).

// Issue #681.
__( 'String with a literal %%', 'my-slug'); // Ok, replacement would be a single %.
__( 'String with a literal %% and a %s placeholder', 'my-slug'); // Ok.
__( 'A replacement variable can not start with "%%cf_" or "%%ct_" as these are reserved for the WPSEO standard variable variables for custom fields and custom taxonomies. Try making your variable name unique.', 'my-slug' ); // Ok.

// Issue #698 - fix for auto-fixing placeholder ordering.
__( '%s - %s - %s - %s', 'my-slug' ); // Bad - Multiple of the same placeholders.
__( '%d - %d - %d - %d', 'my-slug' ); // Bad - Multiple of the same placeholders.
__( '%% - %b - %c - %d - %e - %E - %f - %F - %g - %G - %o - %s - %u - %x - %X', 'my-slug' ); // Bad - All simple variations.
__( "%d for %d 'item'", 'my-slug' ); // Bad - Multiple of the same placeholders in a double quoted string.
__( '%04d for %02d item', 'my-slug' ); // Bad - Placeholder with other specifier, but no position.
__( "%04d for %'.9d item", 'my-slug' ); // Bad - Placeholder with other specifier, but no position, double quoted string.

// Related to issue #698 - mixed ordered and non-ordered placeholders.
__( '%1$d for %d item', 'my-slug' ); // Bad.
__( '%1$d for %d and %d item', 'my-slug' ); // Bad.

// Nowdoc syntax.
__( <<<'EOD'
%1$d for %d item
EOD
, 'my-slug' ); // Bad.

// Multi-line heredoc syntax.
_nx( <<<'EOD'
I have
%d cat and %d
dog.
EOD
, <<<'EOD'
I have
%d cats and %d
dogs.
EOD
, $number, <<<'EOD'
Not
really.
EOD
, 'my-slug' ); // OK.

// phpcs:set WordPress.WP.I18n text_domain[] my-slug,default
__( "String default text domain.", "my-slug" ); // Ok.
__( "String default text domain.", "default" ); // Ok.
__( "String default text domain.", 'something' ); // Bad, text domain mismatch.
__( 'String default text domain.' ); // Warning, use default.

// phpcs:set WordPress.WP.I18n text_domain[] default
__( 'String default text domain.', 'my-slug' ); // Bad because text_domain is only 'default'.
__( 'String default text domain.', 'default' ); // Warning, text domain can be omitted.
__( 'String default text domain.', /* Explicitly set for reason. */ 'default' ); // Warning, text domain can be omitted (not auto-fixable).
__( 'String default text domain.' ); // Ok because default domain is 'default' and it matches one of the supplied configured text domains.

// Issue #1266.
// phpcs:set WordPress.WP.I18n text_domain[] my-slug
$mo->translate( $string ); // OK, not a function, but a method call.
Something\esc_html_e( $string ); // OK, not the WP function, but namespaced function call.

// Issue #719.
class Foo {
	public function translate( $key ) {
		return '';
	}
}

// Issue 1355.
$offset_or_tz = _x( '0', 'default GMT offset or timezone string', 'my-slug' );

$test = __( '%1$s %2$s', 'my-slug' ); // OK(ish), placeholder order may change depending on language.
$test = __( '   %s    ', 'my-slug' ); // Bad, no translatable content.

// Missing plural argument.
_n_noop($singular); // Bad x 3.

// This test is needed to verify that the missing plural argument above does not cause an internal error, stopping the run.
_n_noop( 'I have %d cat.', 'I have %d cats.' ); // Bad.

// HTML wrapped strings.
__( '<address>123 Fake Street</address>', 'my-slug' ); // Bad, string shouldn't be wrapped in HTML.
__( 'I live at <address>123 Fake Street</address>', 'my-slug' ); // Okay, no consensus on HTML tags within strings.
__( '<address>123 Fake Street</address> is my home', 'my-slug' ); // Okay, no consensus on HTML tags within strings.
__( '<span>Text</span> More text <span>Text</span>', 'my-slug' ); // Good, we're not wrapping
__( '<div class="my-class">Translatable content</div>', 'my-slug' ); // Bad
__( '<option id="%1$s" value="%2$s">Translatable option name</option>', 'my-slug' ); // Wrapping is okay, since there are placeholders
__( '<b><i>Foo</i></b>', 'my-slug' ); // Bad
__( '<foo>Foo</foo>', 'my-slug' ); // Good

// Strings wrapped in `<a href="...">...</a>` aren't flagged, since the link target might require localization.
__( '<a href="http://wordpress.org">WordPress</a>', 'my-slug' ); // Good
__( '<a id="anchor">translatable text</a>', 'my-slug' ) // Bad, since no href
__( '<a>translatable text</a>', 'my-slug' ) // Bad, since no href
__( '<a href="%s">translatable text</a>', 'my-slug' ) // Good

// Strings containing malformed XML, to make sure we're able to parse them. No warnings should be thrown.
__( '<div>text to translate', 'my-slug' );
__( 'text to <div>translate', 'my-slug' );
__( 'text < to translate', 'my-slug' );
__( 'text to > translate', 'my-slug' );
__( '<div data-type=">foo">my address</div>', 'my-slug' );
__( '<div>text to translate<div>', 'my-slug' );
__( '<>text to translate</>', 'my-slug' );
__( '<>text to translate<>', 'my-slug' );
__( '<div><div>', 'my-slug' );
__( '<<>>text to translate<<>', 'my-slug' );
__( '<<>>123</<>', 'my-slug' );
__( '<b><i>Foo</b></i>', 'my-slug' );
__( '<b><i>Foo</b></i></b>', 'my-slug' );
__( '<foo>Foo</bar>', 'my-slug' );

// phpcs:set WordPress.WP.I18n text_domain[]
// phpcs:set WordPress.WP.I18n check_translator_comments true

// Test handling of more complex embedded variables and expressions.
__( "${foo}", 'my-slug' );
__( "{$foo['bar']}", 'my-slug' );
__( "{$foo->bar()}", 'my-slug' );
__( "{$foo['bar']->baz()()}", 'my-slug' );
__( "${foo->bar}", 'my-slug' );
__( "${foo["${bar['baz']}"]}", 'my-slug' );
