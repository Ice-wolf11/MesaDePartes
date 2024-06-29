
        document.getElementById('tipoDocumento').addEventListener('change', function() {
            var otroTipoDocumentoGroup = document.getElementById('otroTipoDocumentoGroup');
            if (this.value === 'otros') {
                otroTipoDocumentoGroup.style.display = 'block';
                document.getElementById('otroTipoDocumento').required = true;
            } else {
                otroTipoDocumentoGroup.style.display = 'none';
                document.getElementById('otroTipoDocumento').required = false;
            }
        });
