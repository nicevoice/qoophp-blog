#########################################################################
# File Name: wget.sh
# Author: ma6174
# mail: ma6174@163.com
# Created Time: 五  2/14 17:39:32 2014
#########################################################################
#!/bin/bash

FILE="fontawesome-webfont.woff se7en.svg se7en.woff Ufontawesome-webfont.ttf se7en.ttf fontawesome-webfont.svg"

for x in $FILE
do
	PATH="http://www.zi-han.net/theme/se7en/font/${x}"
	echo $PATH
	/usr/local/bin/wget $PATH
done
