# https://github.com/elastic/logstash-docker
ARG ELASTIC_VERSION
FROM logstash:${ELASTIC_VERSION}

USER root

RUN apt-get update

COPY mysql-connector-j-8.2.0.jar /usr/share/logstash/logstash-core/lib/jars/mysql-connector-j-8.2.0.jar
# Add your logstash plugins setup here
# RUN logstash-plugin install logstash-input-jdbc
# Example: RUN logstash-plugin install logstash-filter-json

# RUN logstash-plugin install logstash-input-syslog
# RUN logstash-plugin install logstash-filter-date
# RUN logstash-plugin install logstash-filter-grok
# RUN logstash-plugin install logstash-filter-useragent
# RUN logstash-plugin install logstash-output-elasticsearch
# /usr/share/logstash/logstash-core/lib/jars