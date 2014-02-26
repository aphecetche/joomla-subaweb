
export COPY_EXTENDED_ATTRIBUTES_DISABLE=true
export COPYFILE_DISABLE=true

dest="$HOME/Sites/joomla-dev/packages/subatech.tar.gz"
src="$HOME/Sites/joomla-dev/importlabo/mamp.subatech.in2p3.fr"

rm -f $dest

a=`pwd`

component="subatech"

dir=$a/com_$component

mkdir $dir 

cp -a $src/administrator/components/com_$component/ $dir/admin

cp -a $src/components/com_$component/ $dir/site

cp -a $src/media/com_$component/ $dir/media

cp $component.xml $dir/

rm $dir/admin/$component.xml

tar -c --exclude='._*' --exclude='.svn' --exclude='.DS_Store' --exclude='*.bak' --exclude='*~' --exclude='.project'  -vzf $dest com_$component

rm -rf $dir