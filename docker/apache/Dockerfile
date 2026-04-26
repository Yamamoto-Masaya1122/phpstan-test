FROM httpd:2.4-alpine

# 必要なパッケージのインストール
RUN apk update && \
    apk add --no-cache \
        curl \
        unzip

# Apacheの設定ファイルをコピー（必要に応じて）
COPY ./default.conf /usr/local/apache2/conf/httpd.conf

# ドキュメントルートにファイルをコピー（必要に応じて）
# COPY ../../public/ /usr/local/apache2/htdocs/

# ポート開放
EXPOSE 80

# フォアグラウンドでApache実行（デフォルトのCMD）
CMD ["httpd-foreground"]