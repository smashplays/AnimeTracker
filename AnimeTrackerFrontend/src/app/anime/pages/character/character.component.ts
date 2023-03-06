import { Component } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import { Character } from '../../interfaces/character';
import { CharacterService } from '../../services/character.service';
import { AnimeCharacter } from '../../interfaces/anime-character';
import { Voices } from '../../interfaces/voices';
@Component({
  selector: 'app-character',
  templateUrl: './character.component.html',
})
export class CharacterComponent {
  selectedCharacter: Character;
  characterAnime: AnimeCharacter;
  characterVoices: Voices;
  anime: boolean = true;
  actor: boolean = false;

  constructor(
    private route: ActivatedRoute,
    private characterService: CharacterService
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
    this.characterService
      .getCharacterVoices(id)
      .subscribe((voices) => (this.characterVoices = voices));
  }

  animeBool() {
    this.anime = true;
    this.actor = false;
  }

  voiceActorBool() {
    this.actor = true;
    this.anime = false;
  }
}
