#!/bin/sh

# ---- should be modified if necessary ----

# Module type
MOD_TYPE="theme"

# Default module version
DEF_VERSION="0.1"

# Path for JS minifier
MIN_JS="../../git-dc/build-tools/min-js.php"

# ---- nothing to modify below ----

# Find module name
MOD_NAME=$(basename "$PWD")
[ -z "$MOD_NAME" ] && { echo "Unable to find module name!" ; exit 1; }

# Copy all files to tmp dir
if [ -d "$MOD_NAME" ]; then
  rm -rf ./"$MOD_NAME"
fi
mkdir ./"$MOD_NAME"
rsync --exclude="$MOD_NAME" --exclude="mkdocs" --exclude="build.sh" --exclude=".git*" --exclude=".DS_Store" --exclude="*.zip" --exclude="*.map" --exclude="*.rb" --exclude="sass" --exclude="scss" --exclude=".sass*" --exclude="scripts" -a . ./"$MOD_NAME"

# Pack Javascript files
if [ -z "$MIN_JS" ]; then
  find ./"$MOD_NAME" -name '*.js' -exec $MIN_JS \{\} \;
fi

# Find last version (if any)
CUR_VERSION=$(git tag -l | sort -r -V | grep -E "[0-9]" | head -n 1)
if [ -z "$CUR_VERSION" ]; then
  CUR_VERSION=$DEF_VERSION
fi

# Make installable archive
if [ -f $MOD_TYPE-"$MOD_NAME"-$CUR_VERSION.zip ]; then
  rm $MOD_TYPE-"$MOD_NAME"-$CUR_VERSION.zip
fi
zip -q -r $MOD_TYPE-"$MOD_NAME"-$CUR_VERSION.zip ./"$MOD_NAME"/

# Cleanup
rm -rf ./"$MOD_NAME"

# Final output
echo "$MOD_TYPE-$MOD_NAME-$CUR_VERSION.zip ready!"
