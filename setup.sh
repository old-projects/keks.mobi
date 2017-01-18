#!/bin/bash
folders=(assets tmp protected/runtime files screenshots download)
for folder in "${folders[@]}"; do
	if ! [ -d "$folder" ]; then
		echo "Creating folder $folder ..."
		mkdir -m 777 "$folder"
	fi
	if [[ `ls -dl "$folder" | awk '{print $1}'` !=  "drwxrwxrwx" ]]; then
		echo "Chmoding $folder ..."
#		echo `ls -dl $folder`
		chmod 777 "$folder"
	fi
done
