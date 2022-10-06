FROM wyveo/nginx-php-fpm:php81
WORKDIR /app

ARG NODE_VERSION=14.17.5
ARG XDEBUG_VERSION=2.6.0
RUN apt-get update && apt-get install -y curl php8.1-dev php8.1-xdebug

# install xdebug
# RUN pecl install xdebug-${XDEBUG_VERSION} \
#     && docker-php-ext-enable xdebug

ARG NVM_VERSION=0.39.0
RUN curl -o- https://raw.githubusercontent.com/nvm-sh/nvm/v${NVM_VERSION}/install.sh | bash
ENV NVM_DIR=/root/.nvm
RUN . "$NVM_DIR/nvm.sh" && nvm install ${NODE_VERSION}
RUN . "$NVM_DIR/nvm.sh" && nvm use v${NODE_VERSION}
RUN . "$NVM_DIR/nvm.sh" && nvm alias default v${NODE_VERSION}
ENV PATH="/root/.nvm/versions/node/v${NODE_VERSION}/bin/:${PATH}"

COPY . ./
ARG ENV=dev
# RUN composer update
CMD /start.sh
