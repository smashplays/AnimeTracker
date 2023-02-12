import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Anime } from '../interfaces/anime';
import { map, Observable } from 'rxjs';

@Injectable({
  providedIn: 'root',
})
export class AnimeService {
  constructor(private http: HttpClient) {}

  private animeUrl: string = 'https://api.jikan.moe/v4/anime';

  public getAnimeById(id: number): Observable<Anime> {
    return this.http
      .get<Anime>(this.animeUrl + '/' + id)
      .pipe(map((resp: Anime) => resp));
  }
}
