#!/bin/sh
read test
git add -A
git commit -m "$test"
git push
cd ~
ssh root@codell.com.br "./pull.sh"
