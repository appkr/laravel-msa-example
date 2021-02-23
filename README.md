## laravel-msa-example

### 구성 요소
- API Client
- OAuth2 Server
- 라라벨로 만든 마이크로서비스
- 다른 프레임워크로 만든 마이크로서비스

### 요건

![](docs/laravel-msa-demo.png)

- ① API Client는 `web_app/changeit` 사용자 계정과 Password Grant를 이용하여 OAuth2 Server로부터 `JWT(Json Web Token)`를 발급 받는다
  - ② API Client는 발급 받은 JWT로 라라벨로 만든 마이크로서비스의 보호된 API 리소스를 조회, 변경할 수 있다
  - 서버는 `JWT`의 `user_name` 클레임의 값을 API 리소스의 `created_at`, `updated_at`의 값으로 사용한다
  - API Client가 제출한 토큰이 유효하지 않을 때 서버는 예외 응답을 제공한다
```bash
# Password Grant로 OAuth2 Server로부터 JWT 얻기
$ curl -L -X POST 'http://localhost:9999/oauth/token' \
  -H 'Content-Type: application/x-www-form-urlencoded' \
  -H 'Accept: application/json' \
  -H 'Authorization: Basic  d2ViX2FwcDpjaGFuZ2VpdA==' \
  --data-urlencode 'grant_type=password' \
  --data-urlencode 'username=user' \
  --data-urlencode 'password=user' \
  --data-urlencode 'scope=openid'

{
  "access_token": "eyJhbGciOiJSUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c2VyX25hbWUiOiJ1c2VyIiwic2NvcGUiOlsib3BlbmlkIl0sImV4cCI6MTYxMjQ5ODAyMywiaWF0IjoxNjEyNDk3NzIzLCJhdXRob3JpdGllcyI6WyJST0xFX1VTRVIiXSwianRpIjoiREJmM0g0NHRlVFhOVmNEWjBBeWJTQUY3dFBZIiwiY2xpZW50X2lkIjoid2ViX2FwcCJ9.Y4py8MMHJdMwbXxpocdQPrMEevRnl2nkEUuXw6UeRmtB7qWDFADmzO-xQz8Hkvmz2LT0U4gPSHvRSOEWGuZ_Nack8MRU7ICWGRl53WZyiPTzt7ucLcO0w1eOBUPFxsHQHffyZ4XzrDJWlqWadhzlnxw9oJUcvi8aAKkBtBSVOCslxYMkBNzs7vjxbLHNQIAjZbb1YetBzpAQOq8RJCdSQNDcMSZ9eZG705ucaFBv3LgDf5sxK47Yqqqk3oCMDdyMXB2MW2bsFivpf6BZd3ydfHrCgcrU5y2Vl2g6fG6PsADkaJ4Fv31UdVj0QG-kX8fgj9GL7MjZUyI-bWruiLNTgw",
  "token_type": "bearer",
  "refresh_token": "eyJhbGciOiJSUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c2VyX25hbWUiOiJ1c2VyIiwic2NvcGUiOlsib3BlbmlkIl0sImF0aSI6IkRCZjNINDR0ZVRYTlZjRFowQXliU0FGN3RQWSIsImV4cCI6MTYxMzEwMjUyMywiaWF0IjoxNjEyNDk3NzIzLCJhdXRob3JpdGllcyI6WyJST0xFX1VTRVIiXSwianRpIjoicDhWQVB5aWhHU3NGYXlma1pMWnd1MURLSHBrIiwiY2xpZW50X2lkIjoid2ViX2FwcCJ9.gD4uoRwk_kbX19uUBxnUdvmu3KDZBrTLWeY0h6lj-UVvhKaUF7BNH1AzwSfX10y-tYjdfElk7_m7x6Vo9gG93HMUPtnSQPPNknI6KcE4sFRRs-Wk15o74S7ukiSjvdtq9Bx2u7t6EEd3e1UHHcRYLFwxJUND53YRM7VR38QWhJgxGW6aA6EK4Rz7fgqFaylK8xWlFjhYoFl3w_VBErqDZWyprKRl9IDDrd6xCo-5RIauuLGGvMTim9IhedaSwTDN7fJz68tyJinfejIjEVjnw90MPCAKzwYY2As30i7AdIPzUrvJPHSjhlZnZ9lSU6_BufQUw1caBQe-vSbtXx0pMw",
  "expires_in": 299,
  "scope": "openid",
  "iat": 1612497723,
  "jti": "DBf3H44teTXNVcDZ0AybSAF7tPY"
}
```

- 라라벨로 만든 마이크로서비스는 `internal/internal` 클라이언트 계정과 ClientCredentials Grant를 이용하여 OAuth2 Server로 부터 `JWT`를 발급 받는다
  - ③ 라라벨로 만든 마이크로서비스는 발급 받은 JWT로 다른 프레임워크로 만든 마이크로서비스의 보호된 API 리소스를 조회, 변경할 수 있다
```bash
# ClientCredentials Grant로 OAuth2 Server로부터 JWT 얻기
$ curl -L -X POST 'http://localhost:9999/oauth/token?grant_type=client_credentials' \
-H 'Content-Type: application/x-www-form-urlencoded' \
-H 'Accept: application/json' \
-H 'Authorization: Basic  aW50ZXJuYWw6aW50ZXJuYWw='

{
  "access_token": "eyJhbGciOiJSUzI1NiIsInR5cCI6IkpXVCJ9.eyJzY29wZSI6WyJ3ZWItYXBwIl0sImV4cCI6MTYxMjQ5OTQ4MSwiaWF0IjoxNjEyNDk3NjgxLCJhdXRob3JpdGllcyI6WyJST0xFX0FETUlOIl0sImp0aSI6IjVaUF9kV3pVbnhDX0NkeEk3SnlYNXRsWmdBYyIsImNsaWVudF9pZCI6ImludGVybmFsIn0.bqBNAmVV6YDfXlHBdnBl0jC7sEnc84l1wdN3ejFNXqvQ2qP4qT5cx9Hub60v2XLpeG6wr950ov0NOIYrH0P4YSvvfNW6O55sbNby5QB7wd9y5uVKulxKjma6aJh6ozKlckIkjwVtP08ghuYENcDQIs9iuFZtfFBnc_hYKFiBDH33g3OrylHCHPgNUnjuNm6D10LNAT291e8fTmQROtkWPKmV-Rq7PlRoQlWE7ZlQY23S7uxk05AwP9k5BFTpJhLifKVuZzMDa29wYGFpVzFjLznwi0EGaMsiQPPx8jH-OJHTAuMUWeMrIW8Akd7QW0VoHQn4EluU8GkcCiXpLVbitQ",
  "token_type": "bearer",
  "expires_in": 1799,
  "scope": "web-app",
  "iat": 1612497681,
  "jti": "5ZP_dWzUnxC_CdxI7JyX5tlZgAc"
}
```

- ④ 라라벨로 만든 마이크로서비스는 OAuth2 Server가 제공하는 키를 이용하여 API Client가 제출한 JWT의 유효성을 검증한다
```bash
# OAuth2 Server로부터 JWT 검증을 위한 키 조회하기
curl -L -X GET 'http://localhost:9999/oauth/token_key'
{
    "alg": "SHA256withRSA",
    "value": "-----BEGIN PUBLIC KEY-----\nMIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAlo/L8mU9Isiihp1ksxeOrJzPn4915xZC/pnbO+ur/ccZL23BYHP/wUxpWZy8Gh94+GK8/gcjVEk66acg4Gk7NH0uQGxdrq8WDMywPIAawekwiQJd6l/yVNXIDhuk0LzcgmU+1ESyeTNdlx84Z0X3HI6w8SH6OE4RBcr9rGfIt0ytXmHj1P4zxmJt/YhZyyyUq0WGuBq31UaQTOiJa0rp1kDKSMN0Hvz4UmkYtUvgtqUujrqNcWkSEummO8WyuhnCs+zAaF2KA5XSalEXFNiILwFPtQFxqIQrjjiWcI61vvTxtor4zI5r4X6aDteYIJidAzYwkIiuacnLWX5ziL3j+wIDAQAB\n-----END PUBLIC KEY-----"
}
```

발급 받은 토큰과 키를 [jwt.io](https://jwt.io/)에 제출해서 디코드해보면 아래와 같다

<table>
  <tr>
    <th>Password Grant로 얻은 JWT</th>
    <th>ClientCredentials Grant로 얻은 JWT</th>
  </tr>
  <tr>
    <td><img src="docs/password.png" alt="" style="max-width: 300px; margin-left: auto; margin-right: auto;"></td>
    <td><img src="docs/client_credentials.png" alt="" style="max-width: 300px; margin-left: auto; margin-right: auto;"></td>
  </tr>
</table>

요건을 시퀀스 다이어그램으로 표현하면 아래와 같다

![](docs/sequence.svg)

---

### 프로젝트 실행

```bash
$ cp .env.example .env
$ docker-compose -f docker/docker-compose.yml up -d
$ docker exec -it laravel composer install
$ open http://localhost:8000
```

### 작동 실험 ①

```bash
$ RESPONSE=$(curl -s -X POST --data "username=user&password=user&grant_type=password&scope=openid" http://web_app:changeit@localhost:9999/oauth/token)
$ ACCESS_TOKEN=$(echo $RESPONSE | jq .access_token | xargs)
```

### 작동 실험 ②

```bash
$ curl -s -H 'Accept:application/json' -H "Authorization: bearer ${ACCESS_TOKEN}" http://localhost:8000/api/examples
```

### 작동 실험 ③

```bash
~/laravel-msa-example/hello-service $ ./gradlew clean bootRun
$ curl -s -H 'Accept:application/json' -H "Authorization: bearer ${ACCESS_TOKEN}" http://localhost:8000/api/hello
```

---

### Domain Example

Singer, Song, Album 도메인을 만드는 예제 프로젝트

![](https://raw.githubusercontent.com/appkr/msa-starter-example/master/docs/class.svg)

- To download postman collection click [https://www.getpostman.com/collections/652dbeb6e1757b9db44d](https://www.getpostman.com/collections/652dbeb6e1757b9db44d)
- For companion project developed in SpringBoot @see [https://github.com/appkr/msa-starter-example](https://github.com/appkr/msa-starter-example)
