#!/bin/bash

msg=$1
version=$2

HOME_FOLDER=/home/canos/workspace/ntk-wordpress-notikumi-ticketing-plugin
TARGET_FOLDER=/home/canos/workspace/ntk-wordpress-notikumi-ticketing-plugin-svn

mkdir -p $TARGET_FOLDER/notikumi-ticketing/trunk/

rsync -avz --exclude=.git/ $HOME_FOLDER/* $TARGET_FOLDER/notikumi-ticketing/trunk/ 

cd $TARGET_FOLDER/notikumi-ticketing/

# Adding new files
svn st | grep ^? | sed 's/?    //' | xargs svn add

# committing
svn ci --username=canoset -m "$msg"


# svg cp trunk tags/$version

