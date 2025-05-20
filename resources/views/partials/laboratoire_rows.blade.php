 @foreach($laboratoires as $labo)
                <tr>
                  <td>{{ $labo->User->name }}</td>
                  <td>{{ ucfirst($labo->specialty) }}</td>
                  <td>{{ $labo->User->tel }}</td>
                  <td>
                    {{ $labo->price ? number_format($labo->price, 0, ',', ' ') : '—' }}
                  </td>
                  <td>
                    @if($labo->available)
                      <span class="badge bg-success">Oui</span>
                    @else
                      <span class="badge bg-secondary">Non</span>
                    @endif
                  </td>
                  <td>
                    {{ $labo->rating ? $labo->rating . '/5' : '—' }}
                  </td>
                  <td>
                    @if($labo->home_visit)
                      <span class="badge bg-success">Oui</span>
                    @else
                      <span class="badge bg-secondary">Non</span>
                    @endif
                  </td>
                  <td>
                    <a href=""
                       class="btn btn-sm btn-outline-primary">
                      <i class="fas fa-calendar-plus"></i> Prendre RDV
                    </a>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>

      <div class="modal-footer">
        <button type="button"
                class="btn btn-secondary"
                data-bs-dismiss="modal">
          Fermer
        </button>
      </div>
    </div>
  </div>
</div>
