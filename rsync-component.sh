#!/bin/sh

# copy the version from the local dev installation
# to this git directory to 

topdir=$HOME/Mind/@Archive/2018/joomla-dev/importlabo/www/components/com_subatech/

rsync -avz ${topdir} components/com_subatech


