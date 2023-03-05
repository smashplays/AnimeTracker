import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Anime } from '../interfaces/anime';
import { map, Observable, of } from 'rxjs';
import { Characters } from '../interfaces/characters';
import { AnimeSearch, Data } from '../interfaces/anime-search';
import { AnimeAdd } from '../interfaces/anime-add';
import { Respuesta } from 'src/app/user/interfaces/user';
import { AnimeUser } from '../interfaces/anime-user';

@Injectable({
  providedIn: 'root',
})
export class AnimeService {
  constructor(private http: HttpClient) {}

  private animeUrl: string = 'https://api.jikan.moe/v4/anime';
  private URL: string = 'http://localhost:8000/api/';

  private headers = new HttpHeaders()
    .set('content-type', 'application/json')
    .set('Access-Control-Allow-Origin', '*')
    .set('Authorization', 'Bearer ' + localStorage.getItem('token'));

  public getAnimeById(id: number): Observable<Anime> {
    return this.http
      .get<Anime>(this.animeUrl + '/' + id)
      .pipe(map((resp: Anime) => resp));
  }

  public getAnimeSearch(query: string): Observable<Data[]> {
    if (!query.trim()) {
      return of([]);
    }
    return this.http
      .get<AnimeSearch>(this.animeUrl + '?q=' + query)
      .pipe(map((resp: AnimeSearch) => resp.data));
  }

  public getAnimeCharacters(id: number): Observable<Characters> {
    return this.http
      .get<Characters>(this.animeUrl + '/' + id + '/characters')
      .pipe(map((resp: Characters) => resp));
  }

  public getAnimePopular(page: number): Observable<AnimeSearch> {
    return this.http
      .get<AnimeSearch>(
        this.animeUrl + '?page=' + page + '&order_by=score' + '&sort=desc'
      )
      .pipe(map((resp: AnimeSearch) => resp));
  }

  public getAnimesByUser(): Observable<AnimeUser> {
    return this.http.get<AnimeUser>(this.URL + 'animes');
  }

  public addAnime(data: AnimeAdd): Observable<AnimeAdd> {
    return this.http.post<AnimeAdd>(this.URL + 'animes', data, {
      headers: this.headers,
    });
  }

  public deleteAnime(id: number): Observable<AnimeAdd> {
    return this.http.delete<AnimeAdd>(this.URL + `animes/${id}`, {
      headers: this.headers,
    });
  }

  public checkAnime(id: number): Observable<boolean> {
    return this.http
      .get<Respuesta>(this.URL + `animes/${id}`, { headers: this.headers })
      .pipe(
        map((res) => {
          if (!res.success) {
            return false;
          } else {
            return true;
          }
        })
      );
  }
}
