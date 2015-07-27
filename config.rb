# Require any additional compass plugins here.

require 'autoprefixer-rails'

# Set this to the root of your project when deployed:
http_path = "./"
css_dir = "./"
sass_dir = "scss"
images_dir = "img"
javascripts_dir = "scripts"

# You can select your preferred output style here (can be overridden via the command line):
# output_style = :expanded or :nested or :compact or :compressed
# To enable relative paths to assets via compass helper functions. Uncomment:
# relative_assets = true
# To disable debugging comments that display the original location of your selectors. Uncomment:
output_style = :nested
environment = :development
line_comments = false

Sass::Script::Number.precision = 7

on_stylesheet_saved do |file|
  css = File.read(file)
  map = file + '.map'

  if File.exists? map
    result = AutoprefixerRails.process(css,
      from: file,
      to:   file,
      map:  { prev: File.read(map), inline: false },
      browsers: 'last 5 versions')
    File.open(file, 'w') { |io| io << result.css }
    File.open(map,  'w') { |io| io << result.map }
  else
    File.open(file, 'w') { |io| io << AutoprefixerRails.process(css) }
  end
end
