#!/bin/sh

# Esperar o serviço MinIO estar disponível
while ! curl -s http://minio:9000/minio/health/live; do
    echo "Aguardando MinIO estar pronto..."
    sleep 2
done

echo "MinIO está pronto. Configurando bucket..."

/usr/bin/mc config host add local ${AWS_ENDPOINT} ${AWS_ACCESS_KEY_ID} ${AWS_SECRET_ACCESS_KEY};
/usr/bin/mc rm -r --force local/${AWS_BUCKET};
/usr/bin/mc mb -p local/${AWS_BUCKET};
/usr/bin/mc policy set download local/${AWS_BUCKET};
/usr/bin/mc policy set public local/${AWS_BUCKET};
/usr/bin/mc anonymous set upload local/${AWS_BUCKET};
/usr/bin/mc anonymous set download local/${AWS_BUCKET};
/usr/bin/mc anonymous set public local/${AWS_BUCKET};

exit 0;
