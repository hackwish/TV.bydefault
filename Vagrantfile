Vagrant.configure("2") do |config|

  if Vagrant.has_plugin?("vagrant-cachier")
    config.cache.auto_detect = true
  end

  #Server
  nodos = {
    :lamp => {
      :host => 'tv',
      :domain => 'bydefault.cl',
      :ip => '10.11.12.11',
      :ssh_port => '1211'
      },
  }

  nodos.each do |name, options|
      config.vm.define name do |node|
        node.vm.hostname = "#{options[:host]}.#{options[:domain]}"
        node.vm.box = "ubuntu/xenial64"
        node.vm.box_url = "ubuntu/xenial64"
        node.vm.network :private_network, ip: options[:ip] #, auto_config: false

        node.vm.network :forwarded_port, guest: 22, host: options[:ssh_port], id: "ssh"
        
        # node.vm.provision :hosts do |provisioner|
        #   provisioner.autoconfigure = true
        #   provisioner.add_host '10.11.12.100', ['puppet01.bydefault.cl', 'puppet01', 'puppet']
        # end

        #VIRTUALBOX
        node.vm.provider :virtualbox do |v|
          v.customize ["modifyvm", :id, "--memory", 512]
          v.customize ["modifyvm", :id, "--cpus", 2]
          v.customize ["modifyvm", :id, "--name", options[:host]]
        end

        #SYNC FOLDERS
       node.vm.synced_folder "app", "/var/www/html/#{options[:host]}"

        #PROVISION
        node.vm.provision :shell, :inline => "apt-get update && apt-get upgrade -y && apt-get -y dist-upgrade"

        node.vm.provision :shell, :inline => "debconf-set-selections <<< 'mysql-server mysql-server/root_password password mipassword'"
        node.vm.provision :shell, :inline => "debconf-set-selections <<< 'mysql-server mysql-server/root_password_again password mipassword'"

        node.vm.provision :shell, :inline => "apt-get install vim git curl lamp-server^ -y"

        node.vm.provision :shell, :inline => "cp /vagrant/010-tv.bydefault.dev.conf /etc/apache2/sites-available/"

        node.vm.provision :shell, :inline => "echo '127.0.1.1 bydefault.dev tv.bydefault.dev' >> /etc/hosts"
        node.vm.provision :shell, :inline => "echo '#{options[:ip]} bydefault.dev tv.bydefault.dev' >> /etc/hosts"
        
        node.vm.provision :shell, :inline => "a2ensite 010-tv.bydefault.dev && service apache2 restart"
        node.vm.provision :shell, :inline => "mysql --defaults-extra-file=/vagrant/config.cnf -e 'drop database if exists tv;'"
        node.vm.provision :shell, :inline => "mysql --defaults-extra-file=/vagrant/config.cnf -e 'create database tv;'"
        node.vm.provision :shell, :inline => "mysql --defaults-extra-file=/vagrant/config.cnf tv < /vagrant/tv.sql"


        # node.vm.provision "puppet_server" do |puppet|
        #   puppet.puppet_server = "tx-puppet01-zz1.txel.systems"
        #   puppet.options = "--verbose --debug"
        # end

      end
  end

end