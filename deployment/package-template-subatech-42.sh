
if [ ! -f template-subatech-42.version ]; then
  echo no template-subatech-42.version file !
  exit -1
fi

version=`cat template-subatech-42.version`

a=`pwd`

dest="$HOME/Sites/joomla-dev/packages/subatech-42-$version.tar.gz"
src="$HOME/Sites/joomla-dev/importlabo/mamp.subatech.in2p3.fr/templates/subatech-42"
tmpdir="$HOME/Sites/joomla-dev/tmp/"

rm -rf $tmpdir

mkdir -p $tmpdir

cp -a $src $tmpdir

cd $tmpdir

mv subatech-42 subatech-42-$version

rm -f $dest

cd "$tmpdir/subatech-42-$version"

d=`date "+%Y-%m-%d"`

sed -i bck "s/MYNAME/subatech-42-$version/g" templateDetails.xml
sed -i bck "s/MYVERSION/$version.0.0/g" templateDetails.xml
sed -i bck "s/MYDATE/$d/g" templateDetails.xml

sed -i bck "s/subatech-42/subatech-42-$version/g" *.php

mv language/fr-FR/fr-FR.tpl_subatech-42.ini language/fr-FR/fr-FR.tpl_subatech-42-$version.ini 
mv language/fr-FR/fr-FR.tpl_subatech-42.sys.ini language/fr-FR/fr-FR.tpl_subatech-42-$version.sys.ini
mv language/en-GB/en-GB.tpl_subatech-42.ini language/en-GB/en-GB.tpl_subatech-42-$version.ini
mv language/en-GB/en-GB.tpl_subatech-42.sys.ini language/en-GB/en-GB.tpl_subatech-42-$version.sys.ini

tar -c --exclude='._*' --exclude='.svn' --exclude='.DS_Store' --exclude='*.bak' --exclude='*~' -vzf $dest component.php changes.txt error.php favicon.ico index.html index.php template* js html images fonts css less language

cd $a
