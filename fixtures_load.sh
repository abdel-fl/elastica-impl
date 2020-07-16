#!/usr/bin/env bash

for i in `seq 1 80`;
do
    bin/console d:f:l --append --no-interaction
done
