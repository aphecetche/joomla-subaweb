#!/bin/sh

# copy the version this git checkout to the local installation

topdir=$HOME/github.com/aphecetche/docker-subaweb/www

rsync -avz component/com_subatech ${topdir}/components/com_subatech/ 
rsync -avz administrator/components/com_subatech /${topdir}/administrator/components/com_subatech/ 


