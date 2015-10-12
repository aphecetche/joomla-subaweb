
export COPY_EXTENDED_ATTRIBUTES_DISABLE=true
export COPYFILE_DISABLE=true

module="ldapsearch"

src="$HOME/Sites/joomla-dev/importlabo/mamp.subatech.in2p3.fr"

version=$(grep "<version>" $src/modules/mod_$module/mod_$module.xml)

# version should be something like    <version>X.Y</version> at this stage

version=${version//[[:space:]]/} # remove spaces

version=${version/<version>/} # remove <version>
version=${version/<\/version>/} # remove </version>

dest="$HOME/Sites/joomla-dev/packages/mod_$module-$version.tar.gz"


rm -f $dest

a=`pwd`

cd $src/modules

tar -c --exclude='._*' --exclude='.svn' --exclude='.DS_Store' --exclude='*.bak' --exclude='*~' --exclude='.project'  -vzf $dest mod_$module/*

cd $a