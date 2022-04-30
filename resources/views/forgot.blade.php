<html>

<body>

    <div style="font-family: 'FreeSans', sans-serif">


        <h2>{{ $name }}</h2>

        <p>Foi feita uma solicitação de recuperação de senha para o seu usuário em nosso sistema.</p>

        <h4>Confira seus dados e acesse nosso link de recuperação:</h4>


    </div>

    <table style="width: 100%; color: #333; font-family: 'FreeSans', sans-serif;">
        <thead>
            <tr>
                <td style='width: 250px;'>

                    <img src='{{ $assetsUrl }}/logo.png' />

                </td>
                <td>
                    <table style='width: 100%; padding: 10px;'>
                        <tbody>
                            <tr>
                                <th style='border: 1px solid #a6a6a6; padding: 5px; text-align: justify; font-size: 12px; width: 18%;'>
                                    Nome:
                                </th>
                                <td style='border: 1px solid #a6a6a6; padding: 5px; text-align: justify; font-size: 12px;'>
                                    {{ $name }}
                                </td>
                            </tr>
                            <tr>
                                <th style='border: 1px solid #a6a6a6; padding: 5px; text-align: justify; font-size: 12px; width: 18%;'>
                                    E-mail:
                                </th>
                                <td style='border: 1px solid #a6a6a6; padding: 5px; text-align: justify; font-size: 12px;'>
                                    {{ $email }}
                                </td>
                            </tr>
                            <tr>
                                <th style='border: 1px solid #a6a6a6; padding: 5px; text-align: justify; font-size: 12px; width: 18%;'>
                                    Telefone:
                                </th>
                                <td style='border: 1px solid #a6a6a6; padding: 5px; text-align: justify; font-size: 12px;'>
                                    {{ $phone }}
                                </td>
                            </tr>
                            <tr>
                                <th style='border: 1px solid #a6a6a6; padding: 5px; text-align: justify; font-size: 12px; width: 18%;'>
                                    Computador (IP):
                                </th>
                                <td style='border: 1px solid #a6a6a6; padding: 5px; text-align: justify; font-size: 12px;'>
                                    {{ $ip }}
                                </td>
                            </tr>
                            <tr>
                                <th style='border: 1px solid #a6a6a6; padding: 5px; text-align: justify; font-size: 12px; width: 18%;'>
                                    Data:
                                </th>
                                <td style='border: 1px solid #a6a6a6; padding: 5px; text-align: justify; font-size: 12px;'>
                                    {{ $dataEnvio }}
                                </td>
                            </tr>
                            <tr>
                                <th style='border: 1px solid #a6a6a6; padding: 5px; text-align: justify; font-size: 12px; width: 18%;'>
                                    Assunto:
                                </th>
                                <td style='border: 1px solid #a6a6a6; padding: 5px; text-align: justify; font-size: 12px;'>
                                    Recuperação de Senha
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </td>
            </tr>
        </thead>
        <tbody>

            <tr>
                <td colspan='3'>
                    <table style='width: 100%; padding: 10px;'>
                        <tbody>
                            <tr>
                                <th colspan='3' style='text-align: justify; font-size: 14px; padding-top: 20px; padding-bottom: 10px;'>
                                    Link de Acesso:
                                </th>
                            </tr>
                            <tr>
                                <td style='border: 1px solid #a6a6a6; padding: 5px; text-align: justify; font-size: 12px;'>
                                    <a href="{{ $recoveryLink }}">{{ $recoveryLink }}</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
        <tfoot>
            <tr>
                <td colspan='3'>
                    <div style='width: 100%; font-size:10px; font-family:verdana; text-align:center; position:relative;'>
                        {{ $logradouro}}, {{ $numeroCasa }}, {{ $bairro }} / {{ $estado }}
                        <br />{{ $telefone }}
                        <br /><br />
                        <table style='position: relative; font-size:9px; font-family: verdana; color: #a6a6a6; width: 100%; text-align:center;'>
                            <tr>
                                <td>
                                    <a style='color: #a6a6a6; text-decoration: none;' href='http://www.trilang.com' title='Trilang' target='_blank'>
                                        <img style='position: relative; width: 25px; height: auto; opacity: 90%;' src='{{ $assetsUrl }}/sysIcon.png' /><br /> Documento gerado pelo Trilang {{ $sysname }} - {{ $sysversion }}
                                    </a>
                                </td>
                            </tr>
                        </table>
                    </div>
                </td>
            </tr>
        </tfoot>
    </table>
</body>

</html>