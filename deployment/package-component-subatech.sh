
export COPY_EXTENDED_ATTRIBUTES_DISABLE=true
export COPYFILE_DISABLE=true

component="subatech"

version=$(grep "<version>" $component.xml)

# version should be something like    <version>X.Y</version> at this stage

version=${version//[[:space:]]/} # remove spaces

version=${version/<version>/} # remove <version>
version=${version/<\/version>/} # remove </version>

topdir="$HOME/github.com/aphecetche/joomla-subaweb"
dest="$topdir/packages/component-subatech-$version.tar.gz"

src="$HOME/github.com/aphecetche/docker-subaweb/www"

mkdir -p "$topdir/packages"

rm -f $dest

a=`pwd`

dir=$a/com_$component

mkdir $dir 

cp -a $src/administrator/components/com_$component/ $dir/admin

cp -a $src/components/com_$component/ $dir/site

cp -a $src/media/com_$component/ $dir/media

cp -f $component.xml $dir/

rm -f $dir/admin/$component.xml

tar -c --exclude='._*' --exclude='.svn' --exclude='.DS_Store' --exclude='*.bak' --exclude='*~' --exclude='.project'  -vzf $dest com_$component

rm -rf $dir
