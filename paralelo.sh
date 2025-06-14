#!/bin/bash

php sleep3.php 1 &
PID1=$!

php sleep3.php 2 &
PID2=$!

php sleep3.php 3 &
PID3=$!

wait $PID1
wait $PID2
wait $PID3
