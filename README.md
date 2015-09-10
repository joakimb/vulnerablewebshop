vuln webshop

setup:

$ wget https://dl.bintray.com/mitchellh/vagrant/vagrant_1.7.4_x86_64.deb

$ sudo dpkg -i vagrant_1.7.4_x86_64.deb 

$ wget http://download.virtualbox.org/virtualbox/5.0.4/virtualbox-5.0_5.0.4-102546~Ubuntu~trusty_amd64.deb

$ sudo dpkg -i virtualbox-5.0_5.0.4-102546~Ubuntu~trusty_amd64.deb 

$ git clone git@bitbucket.org:joakimb/vulnerablewebshop.git vulnweb

$ cd vulnweb

$ vagrant up #start vm

$ vagrant ssh #login to vm

Sen kan man se hemsidan på localhost:8080

filer i mappen html kan editeras direkt på host-maskin, VM:ens websever läser därifrån