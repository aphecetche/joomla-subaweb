#!/bin/sh

# copy the version from the local dev installation
# to this git directory to 

topdir=$HOME/github.com/aphecetche/docker-subaweb/www

rsync -avz ${topdir}/components/com_subatech components/com_subatech
rsync -avz ${topdir}/administrator/components/com_subatech administrator/components/com_subatech


