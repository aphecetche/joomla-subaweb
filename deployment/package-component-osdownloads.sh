
export COPY_EXTENDED_ATTRIBUTES_DISABLE=true
export COPYFILE_DISABLE=true

dest="$HOME/Sites/joomla-dev/packages/osdownloads.tar.gz"
src="$HOME/Sites/joomla-dev/importlabo/mamp.subatech.in2p3.fr"

rm -f $dest

a=`pwd`

component="osdownloads"

dir=$a/com_$component

mkdir $dir 

cp -a $src/administrator/components/com_$component/ $dir/admin
mkdir -p $dir/admin/language
cp -a $src/administrator/language/en-GB/*com_$component*.ini $dir/admin/language
cp $dir/admin/index.html $dir/admin/language
mv $dir/admin/install.*.php $dir
mv $dir/admin/$component.xml $dir
cp $dir/admin/index.html $dir

cp -a $src/components/com_$component/ $dir/site
cp -a $src/media/com_$component/ $dir/media

mkdir -p $dir/site/language
cp -a $src/language/en-GB/*com_$component*.ini $dir/site/language
cp $dir/admin/index.html $dir/site/language

cp $component.xml $dir/

#rm $dir/admin/$component.xml

tar -c --exclude='._*' --exclude='.svn' --exclude='.DS_Store' --exclude='*.bak' --exclude='*~' --exclude='.project'  -vzf $dest com_$component

rm -rf $dir