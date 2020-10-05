#!/bin/bash
echo " Stoping All System"
sudo systemctl stop mysql
sudo systemctl stop rabbitmq-server
sudo systemctl status mysql
sudo systemctl status rabbitmq-server

