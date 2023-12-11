# OpenXPKI Install
There are 2 methods to run OpenXPKI yourself (yes, you can try OpenXPKI in the [demo site](http://demo.openxpki.org/)): First, by getting a Debian box ready and download the packages from the [package mirror](http://packages.openxpki.org/), see [https://github.com/openxpki/openxpki](https://github.com/openxpki/openxpki). Second, by using a ready-to-use docker image _whiterabbitsecurity/openxpki3_. In this installation tutorial, we will cover the second method as there will be a complex step in the first method. Also this tutorial is for those who are trying from Windows.

Applications you need to have before following this tutorial:
1. WSL (Windows Subsystem Linux) with Ubuntu installed
2. Docker Desktop (optional)

## Steps
1. Open WSL, find the 'v' (arrow-down) symbol near '+' sign near the terminal tab title, click it
2. Choose "Ubuntu" from the dropdown<br />
![step 1-2](gambar/step1-2.png)
3. (optional) Make a directory and enter it
```shell
mkdir <directory_name> // make directory
cd <directory_name> // enter directory
```
4. Clone the [openxpki-docker](https://github.com/openxpki/openxpki-docker), a new folder is created, enter it. This repo is where the Dockerfile and docker-compose file exists
```shell
git clone https://github.com/openxpki/openxpki-docker.git
cd openxpki-docker
```
5. We need to place a configuration folder. In the current directory, clone the [openxpki-config](https://github.com/openxpki/openxpki-config) repository **community** branch
```shell
git clone https://github.com/openxpki/openxpki-config.git --single-branch --branch=community
```
6. Copy contrib/wait_on_init.yaml  to openxpki-config/config.d/system/ and name it local.yaml
```shell
cp contrib/wait_on_init.yaml  openxpki-config/config.d/system/local.yaml
```
7. Change the _whiterabbitsecurity/openxpki3_ image to 3.24 in **docker-compose.yml** under the **openxpki-server** and **openxpki-client** section. Open **docker-compose.yml** using **nano** by typing `nano docker-compose.yml`. Save it by typing `Ctrl + O`, click `Enter`,  and then type `Ctrl + X` to exit<br />
![step 7](gambar/step7.png)
8. Inside the **openxpki-config** directory, checkout to branch v3.24. Go back to the parent directory
```shell
cd openxpki-config
git checkout v3.24
cd ..
```
9. Run docker-compose as daemon (in the background, so you still be able to input command)
```shell
docker-compose up -d
```
10. Wait until the containers are ready<br />
![step 10](gambar/step10.png)
11. Access [https://localhost:8443/openxpki](https://localhost:8443/openxpki) in your web browser. The system is ready, but without any tokens installed (some user roles need this)<br />
![step 11](gambar/step11.png)
12. To create ready-to-use tokens/certificates, use the _testdrive_
```shell
docker exec -it openxpki-docker-openxpki-server-1 /bin/bash /etc/openxpki/contrib/sampleconfig.sh
```
13. You can also monitor running containers in Docker Desktop<br />
![step 13](gambar/step13.png)

# OpenXPKI Tutorial
## As CA ()


## As RA ()


## As Common Users