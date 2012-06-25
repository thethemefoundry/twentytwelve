# The name of the theme
config[:name] = "Twenty Twelve"

# The website for the theme
config[:uri] = "http://wordpress.org/extend/themes/twentytwelve"

# The author's name
config[:author] = "the WordPress team"

# The author's website
config[:author_uri] = "http://wordpress.org/"

# Description of the theme
config[:description] = "The 2012 theme for WordPress."

# Version number of the theme
config[:version_number] = ".6"

# Name of the theme license
config[:license_name] = "GNU General Public License"

# Website for the theme license
config[:license_uri] = "license.txt"

# Tags for this theme, as an array (ex. ["blue", "white", "two-columns"])
config[:tags] = ['white', 'light', 'two-columns', 'right-sidebar', 'responsive-width', 'custom-background', 'custom-menu', 'microformats', 'post-formats', 'rtl-language-support', 'translation-ready']

# Additional comments (optional)
config[:comments] = "
This theme, like WordPress, is licensed under the GPL.
Use it to make something cool, have fun, and share what you've learned with others."

# JavaScript compression
# config[:compress_js] = false

# Enable livereload
config[:livereload] = true

# Set a higher precision
Sass::Script::Number.precision = 9

# Compass configuration can also go here.
# See http://compass-style.org/help/tutorials/configuration-reference/ for some of the options
# Note: Most options (especially path-related options) will have no effect on Forge

# Compass.configuration do |compass|
#   compass.line_comments = true
#   compass.output_style = :expanded # use :compressed for minified version
# end

# You can also include additional Compass frameworks by requiring them:
# require 'stitch'