
if [ ! -f template-subatech-42.version ]; then
  echo no template-subatech-42.version file !
  exit -1
fi

currentversion=$(cat template-subatech-42.version)
version=$(($currentversion+1))

echo "currentversion=$currentversion version=$version"

a=`pwd`

topdir="$HOME/Mind/@Archive/2017/joomla-dev"

dest="$topdir/packages/subatech-42-$version.tar.gz"
src="$topdir/importlabo/www/templates/subatech-42-$currentversion"
tmpdir="$HOME/tmp/joomla-dev/"

rm -rf $tmpdir

mkdir -p $tmpdir

cp -a $src $tmpdir

cd $tmpdir

mv subatech-42-$currentversion subatech-42-$version

rm -f $dest

cd "$tmpdir/subatech-42-$version"

d=`date "+%Y-%m-%d"`

sed -i bck "s/subatech-42-$currentversion/subatech-42-$version/g" templateDetails.xml
sed -i bck "s/$currentversion.0.0/$version.0.0/g" templateDetails.xml
# sed -i bck "s/MYDATE/$d/g" templateDetails.xml

sed -i bck "s/subatech-42-$currentversion/subatech-42-$version/g" *.php

mv language/fr-FR/fr-FR.tpl_subatech-42-$currentversion.ini language/fr-FR/fr-FR.tpl_subatech-42-$version.ini 
mv language/fr-FR/fr-FR.tpl_subatech-42-$currentversion.sys.ini language/fr-FR/fr-FR.tpl_subatech-42-$version.sys.ini
mv language/en-GB/en-GB.tpl_subatech-42-$currentversion.ini language/en-GB/en-GB.tpl_subatech-42-$version.ini
mv language/en-GB/en-GB.tpl_subatech-42-$currentversion.sys.ini language/en-GB/en-GB.tpl_subatech-42-$version.sys.ini

tar -c --exclude='._*' --exclude='.svn' --exclude='.DS_Store' --exclude='*.bak' --exclude='*~' -vzf $dest component.php changes.txt error.php favicon.ico index.html index.php template* js html images fonts css less language

cd $a
