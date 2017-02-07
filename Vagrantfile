# -*- mode: ruby -*-
# vi: set ft=ruby :

require 'yaml'
current_dir    = File.dirname(File.expand_path(__FILE__))
config     = YAML.load_file("#{current_dir}/app/config/smart.yml")

ip = config['parameters']['smart.vagrant_ip']
name = config['parameters']['smart.project_name']
url = config['parameters']['smart.project_url']

Vagrant.configure(2) do |config|
  config.vm.box = "ubuntu/xenial64"
  config.vm.box_check_update = false

  config.vm.network "forwarded_port", guest: 80, host: 8090
  config.vm.network "forwarded_port", guest: 3306, host: 3360
  config.vm.network "private_network", ip: ip

  if Vagrant::Util::Platform.windows? then
    config.vm.synced_folder ".", "/var/www", type: "nfs"
    if Vagrant.has_plugin?("vagrant-cachier")
        # Configure cached packages to be shared between instances of the same base box.
        # More info on http://fgrehm.viewdocs.io/vagrant-cachier/usage
        config.cache.scope = :box

        # OPTIONAL: If you are using VirtualBox, you might want to use that to enable
        # NFS for shared folders. This is also very useful for vagrant-libvirt if you
        # want bi-directional sync
        config.cache.synced_folder_opts = {
          type: :nfs,
          # The nolock option can be useful for an NFSv3 client that wants to avoid the
          # NLM sideband protocol. Without this option, apt-get might hang if it tries
          # to lock files needed for /var/cache/* operations. All of this can be avoided
          # by using NFSv4 everywhere. Please note that the tcp option is not the default.
          mount_options: ['rw', 'vers=3', 'tcp', 'nolock']
        }
        # For more information please check http://docs.vagrantup.com/v2/synced-folders/basic_usage.html
      end
  else
    config.vm.synced_folder ".", "/var/www", type: "nfs", :linux__nfs_options => ["rw", "no_root_squash", "no_subtree_check"], nfs_version: "4", nfs_udp: false
  end

  config.vm.provider "virtualbox" do |vb|
    vb.gui = false
    vb.memory = "1024"
  end

  config.vm.provision "file", source: "./deploy/apache/project.conf", destination: "/var/www/project.conf"
  config.vm.provision "file", source: "./deploy/phpmyadmin/config.inc.php", destination: "/var/www/config.inc.php"
  config.vm.provision "file", source: "./deploy/phpmyadmin/apache.conf", destination: "/var/www/apache.conf"
  config.vm.provision "shell", path: "./deploy/script.sh", args: [ip, name, url, '1234']
end
