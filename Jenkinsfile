pipeline {
  agent any
  stages {
    stage('Prepare') {
      steps {
         sh 'composer install'
         sh 'rm -rf build/api'
         sh 'rm -rf build/coverage'
         sh 'rm -rf build/logs'
         sh 'rm -rf build/pdepend'
         sh 'rm -rf build/phpdox'
         sh 'mkdir -p build/api'
         sh 'mkdir -p build/coverage'
         sh 'mkdir -p build/logs'
         sh 'mkdir -p build/pdepend'
         sh 'mkdir -p build/phpdox'
      }
    }
    stage('Test') {
      parallel {
        stage('PHP Syntax check') { 
          steps { 
            sh 'vendor/bin/parallel-lint --exclude vendor/ .' 
          } 
        }
        stage('PHP Unit Test'){
          steps {
            sh 'vendor/bin/phpunit -c build/phpunit.xml --log-junit build/logs/junit.xml'
          step([
            $class: 'XUnitBuilder',
            thresholds: [[$class: 'FailedThreshold', unstableThreshold: '1']],
            tools: [[$class: 'JUnitType', pattern: 'build/logs/junit.xml']]
          ])
          publishHTML target: [
            allowMissing: false,
            alwaysLinkToLastBuild: false,
            keepAll: true,
            reportDir: 'build/logs',
            reportFiles: 'index.html',
            reportName: 'E-rec Report',
            reportTitles:'Erecruitment Build Report' 
          ]

          }
        }
        stage('Checkstyle') {
          steps {
            sh 'vendor/bin/phpcs --report=checkstyle --report-file=`pwd`/build/logs/checkstyle.xml --standard=PSR2 --extensions=php --ignore=autoload.php --ignore=vendor/ app/ config/ database/ resources/ routes/ || exit 0'
            checkstyle canRunOnFailed: true,pattern: 'build/logs/checkstyle.xml'
          }
        }
        stage('Lines of Code') { 
            steps { 
                sh 'vendor/bin/phploc --count-tests --exclude vendor/ --log-csv build/logs/phploc.csv --log-xml build/logs/phploc.xml .' 
            } 
        }
        stage('Copy paste detection') {
          steps {
            sh 'vendor/bin/phpcpd --log-pmd build/logs/pmd-cpd.xml --exclude vendor . || exit 0'
            dry canRunOnFailed: true, pattern: 'build/logs/pmd-cpd.xml'
          }
        }
        stage('Mess Detection Report') {
          steps {
            sh 'vendor/bin/phpmd app,config,database,resources,routes xml build/phpmd.xml --reportfile build/logs/pmd.xml --exclude vendor/ --exclude autoload.php || exit 0'
            pmd canRunOnFailed: true, pattern: 'build/logs/pmd.xml'
          }
        }
      }
    }
    stage('Deploy') {
      steps {
        sh 'ansible-playbook -i ansible/production ansible/git.yml'
      }
    }
    
  }
  post { 
      always { 
          echo 'I will always say Hello again!'
      }
      success { 
          echo 'Build Success Ready to Deploy'
      }
  }
}