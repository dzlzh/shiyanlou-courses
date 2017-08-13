#!/usr/bin/env bash

ls -1 courses/*/*/*.md | while read loop
do
  sed -i -f ex "$loop"
done
