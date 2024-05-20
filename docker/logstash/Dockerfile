# https://github.com/elastic/logstash-docker
FROM logstash:8.12.0
USER root
RUN apt-get update
COPY mysql-connector-j-8.4.0 /opt/
# Add your logstash plugins setup here
# RUN logstash-plugin install logstash-input-jdbc
# Example: RUN logstash-plugin install logstash-filter-json
# RUN logstash-plugin install logstash-filter-aggregate
