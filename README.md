vuln webshop

setup:

$ sudo apt-get install vagrant

$ sudo apt-get install virtualbox

$ git clone git@bitbucket.org:joakimb/vulnerablewebshop.git vulnweb

$ cd vulnweb

$ vagrant up //start vm

$ vagrant ssh //login to vm

Sen kan man se hemsidan på localhost:8080

filer i mappen html kan editeras direkt på host-maskin, VM:ens websever läser därifrån