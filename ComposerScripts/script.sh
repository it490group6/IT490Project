#!/bin/bash
echo " Start All System "
sudo systemctl start mysql
sudo systemctl start rabbitmq-server
sudo systemctl status mysql
sudo systemctl status rabbitmq-server
php testRabbitMQServer.php
