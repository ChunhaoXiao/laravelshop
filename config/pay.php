<?php

return [
    'alipay' => [
        // 支付宝分配的 APPID
        'app_id' => '2016091100488536',

        // 支付宝异步通知地址
        'notify_url' => '',

        // 支付成功后同步通知地址
        'return_url' => '',

        // 阿里公共密钥，验证签名时使用
        'ali_public_key' => 'MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAtFrOiWkvuTMSPPGl5G5gr01y9p1X3sqD/O6mRYYzpZ5LkKtLShz5smK8pUowL84oE0ZuSUopb03R+BcMRC5FCZvHlj8hcbBhqWCg6+VVYh0cfoG0EIgI6O7pijJhVks0fkMU7N3Sn1jE/0U+n8qe/6ELd1CTuRLPcjn7vVrcODpcfuNNyBohqNsGVraN7p4AIZyxpB4yAHW00l/RMugYVsEXy64HdZljg8jq9kXUuXfhjMkU3/XXtvGI9Wo8nfFjv22HNYFPu5HkMD4qvz0kUmijdyn2i0AhUC/zilvnVhZ67k559jfPTrBsITK/beMnKFzpylfMqjix4Ns2cC62FwIDAQAB',

        // 自己的私钥，签名时使用
        'private_key' => 'MIIEowIBAAKCAQEA4sL5IvoiE6UfKiV/oCV5bK9i9W77NmgVml+6jaRDzdb5tuQDKZ/wQalYW1KCQ8GFtuz593pC9heHrC/VE0eFNyi/fZlv7UPRVf/tOTl5dGXqLlqGrbdcGKHk+0+hSHgwNtdGKvgOUFQLbpkvrHn4RXfByasE3M6PS8j77j0M1/+LBspt0jPBwyqtmAlqmc2YXCuGJoq2VzglXNidkhiU/labeJE+NiTFFqR1PROTLp8iHKRlFTzrvJJqsqjkb13PaA1rBmLrdLPcRYCpi46I3dCYYSWafzXcl3dFA9nwphYzC9MyNLdDrvCcOIrat6wBMGt+54nNYs9BEPDpu+PG5QIDAQABAoIBAH0q4DhFV6/+UiCCiFsOtGKgwP/23aWfeGU4+BGdHWwugLJKU9CTHxwvbL0j4xGhbbyWPDg1fWa3gEU0NeopbUgQLvsWSejuqUtONFSE/Bya8NPbVkHnV2elXW62+rC03vA2jd3EBKqkaZcH6X/L55X4z7gQtWNohUJw01cizccflgC4JPQf14GzAe5YgTxxthcNS75etSoqHepe5VgYl0pJIpJmpjg41ji1ZYAH8NeNnRw6HXry7syeDzZTXczUc3H16XbTLPBEN95omyrOuLV5QpLSaiWTMq6c8hjPrtRkNrMgNqbz3HY1h/ism3KWqwKE1I4i8YSovWDL8tMHkpUCgYEA/P7KDytr32h8pPXZO4FZEFbcnYpYiytcRBt9e+aZAdxWmUrV471dGbZS4HYdhYle+9Oqfrjt7L0nmfrHXWBkR7/3FHxy/8ehGvwx3IseWL/1gHjO8N1YsjKt0MklNAz4m1JxMEf7oRm8UYIZWUvLozcWvlbHMh39w5DXOFKSRPMCgYEA5XRsNPtewyRgZ6LJYjCSsEDmAxKD762mnrlD3YVwtC6ShMaJpjb5JYtyZPbC3kx/kssbs0X6h76Cuo0iL8QQ41/66awtRwFFVqD6Um/uvoNHiywlzFRX3Br6vs//crWreRYv+9vbwqsLBOnjEI21mSmIG3y+ZCiAqOe3GlvymscCgYBOHTEwK9z7ttw9Zrcy+0YPmHI3pj6egb3UPZSqC9IUU/7dB9Ewpwg25yeBrJaC455TLNCInfrATMsMbPTfbOKpkKjuR1qOhQnGNjYC/WVaS7K2fxaOIhm/s4wdWe3Fu3eLJZJTMPaNkE+n7v56pr9yXpEEJfENFVuD5ZW+CyikZwKBgQDaR3O8vzi5uTxAurqLPxv8sfBeEdoTQwXTzvjBnnTF49wclWZTCc7gKZUMeTaOFQXzlmZml/ap9dEVOLfB6uoJ87+VVebIumvE6mTX0YW0FN0Vh0z54W6ng77vkJ04+ZwDF9lT5iZcPSzBYuJQWA7egoTpaTURwPoMNEqat8fF9wKBgFXcMhB7/MOMbW/4g9saiLD34ZBOeSmKnyUWpngi+DL43i8+lGn51SQYxJHvzOHxtTjltahDd/hK60AQF3XB7mWEKdPWxUXIyS3/lLlnKZfaWlGMASmMggoHBwCMa3LhA8i+klQLo5/k+McDz/P4fTH3P9Bv4vVmSfc8SX6ilWtV',

        // optional，默认 warning；日志路径为：sys_get_temp_dir().'/logs/yansongda.pay.log'
        'log' => [
            'file' => storage_path('logs/alipay.log'),
        //     'level' => 'debug'
        ],

        // optional，设置此参数，将进入沙箱模式
         'mode' => 'dev',
    ],

    'wechat' => [
        // 公众号 APPID
        'app_id' => '',

        // 小程序 APPID
        'miniapp_id' => '',

        // APP 引用的 appid
        'appid' => '',

        // 微信支付分配的微信商户号
        'mch_id' => '',

        // 微信支付异步通知地址
        'notify_url' => '',

        // 微信支付签名秘钥
        'key' => '',

        // 客户端证书路径，退款、红包等需要用到。请填写绝对路径，linux 请确保权限问题。pem 格式。
        'cert_client' => '',

        // 客户端秘钥路径，退款、红包等需要用到。请填写绝对路径，linux 请确保权限问题。pem 格式。
        'cert_key' => '',

        // optional，默认 warning；日志路径为：sys_get_temp_dir().'/logs/yansongda.pay.log'
        'log' => [
            'file' => storage_path('logs/wechat.log'),
        //     'level' => 'debug'
        ],

        // optional
        // 'dev' 时为沙箱模式
        // 'hk' 时为东南亚节点
        // 'mode' => 'dev',
    ],
];
