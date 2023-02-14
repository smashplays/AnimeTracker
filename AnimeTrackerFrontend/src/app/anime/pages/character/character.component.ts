import { Component } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import { Character } from '../../interfaces/character';
import { CharacterService } from '../../services/character.service';
import { Location } from '@angular/common';
import { AnimeCharacter } from '../../interfaces/anime-character';
@Component({
  selector: 'app-character',
  templateUrl: './character.component.html',
  styleUrls: ['./character.component.css'],
})
export class CharacterComponent {
  selectedCharacter: Character;
  characterAnime: AnimeCharacter;

  constructor(
    private route: ActivatedRoute,
    private characterService: CharacterService,
    private location: Location
  ) {}

  ngOnInit(): void {
    //el + delante de la variable, la convierte en numerica
    const id: number = +this.route.snapshot.paramMap.get('id');
    this.characterService
      .getCharacterById(id)
      .subscribe((character) => (this.selectedCharacter = character));
    this.characterService
      .getCharacterAnime(id)
      .subscribe((anime) => (this.characterAnime = anime));
  }

  public back(): void {
    this.location.back();
  }
}
