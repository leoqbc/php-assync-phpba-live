#!/bin/bash

curl http://localhost:8088 &
PID1=$!

curl http://localhost:8088 &
PID2=$!

curl http://localhost:8088 &
PID3=$!

wait $PID1
wait $PID2
wait $PID3
