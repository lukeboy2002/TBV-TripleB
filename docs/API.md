# TripleB API (voor de app)

Alle adressen beginnen met `/api`. Behalve `login` heeft elk verzoek deze header nodig:

```
Authorization: Bearer <token>
Accept: application/json
```

Alleen spelers met de rol `admin` of `member` die niet geblokkeerd zijn, kunnen de API gebruiken.

## Inloggen

| Methode | URL | Body | Antwoord |
|---|---|---|---|
| POST | `/api/login` | `email`, `password`, `device_name` | `{ token, user }` |
| POST | `/api/logout` | | 204 (token van dit toestel ingetrokken) |
| GET | `/api/me` | | `{ data: user }` |

Max 6 inlogpogingen per minuut.

## Stand en wedstrijden

| Methode | URL | Uitleg |
|---|---|---|
| GET | `/api/players?sort=points&dir=desc` | Stand. `sort`: `username`, `played`, `points`, `avg`, `won`, `cup` |
| GET | `/api/games?page=1` | Gespeelde wedstrijden, 10 per pagina, uitslag met winnaar bovenaan |
| GET | `/api/games/{id}` | Eén wedstrijd |
| GET | `/api/games/current` | Lopende wedstrijd: `remaining` (speelvolgorde) en `eliminated`, of `data: null` |
| POST | `/api/games` | Body `players: [id, id, ...]` (min. 2), optioneel `date`. 409 als er al een loopt |
| POST | `/api/games/{id}/eliminate` | Body `user_id`. Bij de voorlaatste speler is de wedstrijd klaar: `completed: true` |
| POST | `/api/games/{id}/cup-photo` | Multipart, veld `photo` (jpg/png/webp/heic, max 10 MB) |
| GET | `/api/cup-winner` | Laatste bekerwinnaar met foto |

`position` 1 = als eerste afgevallen (de beker), de hoogste positie is de winnaar.

## Agenda

| Methode | URL | Uitleg |
|---|---|---|
| GET | `/api/events` | Komende events, met `my_status` en aantallen |
| GET | `/api/events/{slug}` | Eén event met tekst en wie er komt |
| PUT | `/api/events/{slug}/attendance` | Body `status`: `attending`, `maybe` of `not_attending` |

## Uitproberen zonder app

```bash
curl -X POST https://tbv-tripleb.test/api/login \
  -H "Accept: application/json" \
  -d email=jij@example.com -d password=... -d device_name=curl

curl https://tbv-tripleb.test/api/players -H "Accept: application/json" -H "Authorization: Bearer <token>"
```
