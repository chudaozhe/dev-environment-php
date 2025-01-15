# 启动
```
docker-compose up -d

#容器启动后，不代表里面的服务也准备就绪，里面的服务可能还需要等待片刻，比如：mysql第一次初始化
```
# 使用
nginx配置目录：`nginx/conf/conf.d`

代码目录：`data/www`

浏览器访问 `http://localhost/test.php`

# php
安装了哪些系统命令和php扩展？基于官方镜像`php:8.1.9-fpm`，详见 `php-fpm\dockerfile.md`

您可以根据自己的需要，新增或移除部分命令或扩展，然后build一个新容器镜像
```
cd php-fpm
docker build -t php:[镜像版本号] .
```

# mysql
官方镜像`mysql:8.0.26`，无修改
> 注意：如果mysql已经产生了数据，版本号8.0.26就不能随便改了，改之前需要通过脚本`data/apps/mysql/backup/backup.sh`备份一下

# nginx
官方镜像`nginx:1.21.3`，无修改

# redis 
官方镜像`redis:6.2.5`，无修改

# 正式环境
虽说这是开发环境，但用于正式环境也是没问题的。

mysql不建议用容器，可以考虑物理机单独部署或使用云服务rds

如果用于正式环境，建议新增一个docker-compose文件
`docker-compose-production.yml`


## WSL
### WSL端
```
//进入wsl
wsl

//wsl内部访问 windows目录
ls /mnt/c/Users

//使用windows的记事本打开wls中的文件
root@LAPTOP-CS4M2KDJ:/home# notepad.exe ./a.txt
```

### Windows端
- `文件资源管理器`地址栏输入`\\wsl$` 可查看所有的wsl系统目录

```
//windows访问wsl目录
ls \\wsl.localhost\Ubuntu

//使用 文件资源管理器 打开当前所在的wsl目录
PS Microsoft.PowerShell.Core\FileSystem::\\wsl.localhost\Ubuntu\home> explorer.exe .
////或者
PS Microsoft.PowerShell.Core\FileSystem::\\wsl.localhost\Ubuntu\home> powershell.exe /c start .

//从 Windows 命令行运行 Linux 工具
C:\temp> wsl ls -la
C:\temp> wsl sudo apt-get update
```

#### 混合 Linux 和 Windows 命令
若要使用 Linux 命令 ls -la 列出文件，并使用 PowerShell 命令 findstr 来筛选包含“git”的单词的结果，请组合这些命令：
```
wsl ls -la | findstr "git"
```
若要使用 PowerShell 命令 dir 列出文件，并使用 Linux 命令 grep 来筛选包含“git”的单词的结果，请组合这些命令：
```
C:\temp> dir | wsl grep git
```
若要使用 Linux 命令 ls -la 列出文件，并使用 PowerShell 命令 > out.txt 将该列表输出到名为“out.txt”的文本文件，请组合这些命令：
```
C:\temp> wsl ls -la > out.txt
```
若要使用 Linux 命令 ls -la 列出 /proc/cpuinfo Linux 文件系统路径中的文件，请使用 PowerShell：
```
C:\temp> wsl ls -la /proc/cpuinfo
```
若要使用 Linux 命令 ls -la 列出 C:\Program Files Windows 文件系统路径中的文件，请使用 PowerShell：
```
C:\temp> wsl ls -la "/mnt/c/Program Files"
```

#### 在docker-compose中使用
```
  docker-php-fpm:
    volumes:
      - \\wsl.localhost\Ubuntu\home\PhpstormProjects:/var/www
```
### 参考
https://learn.microsoft.com/zh-cn/windows/wsl/filesystems#file-storage-and-performance-across-file-systems
