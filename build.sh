#!/bin/bash

git pull && bin/console cache:clear && chmod -R 777 var/cache/*
